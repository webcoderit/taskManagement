<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AttendanceMultiSheetReport;
use App\Exports\BatchWiseStudentMultipleSheet;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdmissionRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Admin;
use App\Models\AdmissionForm;
use App\Models\AttendanceLog;
use App\Models\Batch;
use App\Models\Expance;
use App\Models\Intereste;
use App\Models\MoneyReceipt;
use App\Models\Salary;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Session;
class AdminController extends Controller
{
    public function loginForm()
    {
        return view('backend.admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if(!$admin){
            return redirect()->back()->withError('Unauthorised use login');
        }
        if ($admin){
            if (password_verify($request->password, $admin->password)){
                Session::put('id', $admin->id);
                Session::put('name', $admin->name);
                if ($admin->type == 'admin'){
                    return redirect('/admin/dashboard');
                }elseif($admin->type == 'manager'){
                    return redirect('/admin/manager/dashboard');
                }
                else{
                    return redirect('/admin/hr/dashboard');
                }
            }else {
                return redirect()->back()->withError('Password does not match');
            }
        }else {
            return redirect()->back()->withError('Email not match');
        }
    }

    public function deshboard()
    {
        $admissionData = [
            'monthlyWebAdmission' => MoneyReceipt::with('admissionForm')->whereHas('admissionForm', function ($q){
                $q->where('course', 'web');
            })->whereMonth('admission_date', date('m'))->paginate(200),

            'monthlyAdmAdmission' => MoneyReceipt::with('admissionForm')->whereHas('admissionForm', function ($q){
                $q->where('course', 'digital');
            })->whereMonth('admission_date', date('m'))->paginate(700),

            'monthlyEngAdmission' => MoneyReceipt::with('admissionForm')->whereHas('admissionForm', function ($q){
                $q->where('course', 'english');
            })->whereMonth('admission_date', date('m'))->paginate(200),
        ];
        $start = request()->admission_filtering;
        $today = date('Y-m-d', strtotime(Carbon::today()));
        //dd('Start date '.$start. '-' . 'Today date '. $today);
        $startExpanse = request()->expanse_filtering;
        $todayExpanse = date('Y-m-d', strtotime(Carbon::today()));
        $filterAdmission = [
            'admissionDayCount' => MoneyReceipt::whereBetween('admission_date', [$start, $today] )->paginate(200),
        ];
        $filterExpanse = [
            'expanse' => Expance::whereBetween('created_at', [$startExpanse, $todayExpanse] )->paginate(200),
        ];
        $users = User::orderBy('updated_at', 'desc')->get();
        $todayCredit = MoneyReceipt::whereDate('admission_date', Carbon::today())->get()->sum('advance');
        $todayDue = MoneyReceipt::whereDate('admission_date', Carbon::today())->get()->sum('due');
        $monthlyCredit = MoneyReceipt::whereMonth('admission_date', date('m'))->get()->sum('advance');
        $monthlyDebit = MoneyReceipt::whereMonth('admission_date', date('m'))->get()->sum('due');
        $totalDue = MoneyReceipt::with('admissionForm')->orWhere('is_pay', 0)->where('is_reject', 0)->select('is_pay', 'is_reject','due')->get()->sum('due');
        $admissionChats = AdmissionForm::select(\DB::raw("COUNT(*) as count"), \DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(\DB::raw("Month(created_at)"))
            ->pluck('count', 'month_name');

        $labels = $admissionChats->keys();
        $data = $admissionChats->values();

        return view('backend.admin.home.index', compact('users', 'todayCredit',
            'todayDue', 'monthlyCredit',
            'monthlyDebit', 'totalDue',
            'labels', 'data',
            'filterAdmission', 'filterExpanse', 'admissionData'));
    }

    public function hr_dashboard()
    {
        $data = [
            'users' => User::orderBy('updated_at', 'desc')->get(),

            'todayAmountsAdvance' => MoneyReceipt::with('admissionForm')->select(['advance'])->whereDate('admission_date', Carbon::today())->get(),
            'todayAmountsDue' => MoneyReceipt::with('admissionForm')->select(['due'])->whereDate('admission_date', Carbon::today())->get(),

            'monthlyAmountsAdvance' => MoneyReceipt::with('admissionForm')->select(['advance'])->whereMonth('admission_date', date('m'))->get(),
            'monthlyAmountsDue' => MoneyReceipt::with('admissionForm')->select(['due'])->whereMonth('admission_date', date('m'))->get(),

            'monthlyWebAdmission' => MoneyReceipt::with('admissionForm')->whereHas('admissionForm', function ($q){
                $q->where('course', 'web');
            })->whereMonth('admission_date', date('m'))->paginate(200),

            'monthlyAdmAdmission' => MoneyReceipt::with('admissionForm')->whereHas('admissionForm', function ($q){
                $q->where('course', 'digital');
            })->whereMonth('admission_date', date('m'))->paginate(700),

            'monthlyEngAdmission' => MoneyReceipt::with('admissionForm')->whereHas('admissionForm', function ($q){
                $q->where('course', 'english');
            })->whereMonth('admission_date', date('m'))->paginate(200),

            'admissionStudentsBatch' => Batch::select(['batch_no', 'course_name'])->orderByDesc('created_at')->paginate(30),
        ];
        $sql = AdmissionForm::with('moneyReceipt', 'user')->orderByDesc('created_at');

        if (isset(request()->user_id) && isset(request()->date)&& isset(request()->batch_no)){
            $sql->where('user_id', 'LIKE','%'.request()->user_id.'%')->whereHas('moneyReceipt', function ($date){
                $date->where('admission_date', 'LIKE', '%'.request()->date.'%');
            })->where('batch_no', 'LIKE', '%'.request()->batch_no.'%');
            $admissionStudents = $sql->paginate(200);
            $totalDue = MoneyReceipt::orWhere('is_pay', 0)->where('is_reject', 0)->get()->sum('due');
            return view('backend.admin.hrm.index', compact( 'data', 'admissionStudents', 'totalDue'));
        }
        $admissionStudents = '';
        $totalDue = MoneyReceipt::orWhere('is_pay', 0)->where('is_reject', 0)->get()->sum('due');
        return view('backend.admin.hrm.index', compact( 'data', 'admissionStudents', 'totalDue'));
    }

    //======== For admin ==========//
    public function adminStudentList(){
        $sql = AdmissionForm::with('moneyReceipt', 'user')->orderByDesc('created_at');
        if (isset(request()->batch_no)){
            $sql->where('batch_no', 'LIKE','%'.request()->batch_no.'%');
        }
        if (isset(request()->phone)){
            $sql->where('s_phone', 'LIKE','%'.request()->phone.'%');
        }

        if (isset(request()->batch_student)){
            $sql->where('batch_no', request()->batch_student);
        }

        $admissionStudents = $sql->paginate(500);
        $data = [
            'admissionStudentsBatch' => AdmissionForm::select(['batch_no', 'course'])->with('moneyReceipt')->orderByDesc('created_at')->get()->groupBy('batch_no')
        ];
        return view('backend.admin.student.student-list', compact('admissionStudents', 'data'));
    }

    public function studentDownloadFromBatchNumber($batchStudent)
    {
        $sql = AdmissionForm::with('moneyReceipt', 'user')->where('batch_no', $batchStudent);

        $admissionStudents = $sql->get();
        $studentBatchReportPdf = \PDF::loadView('backend.admin.pdf.batch-student-pdf', compact('admissionStudents'))->setPaper([0, 0, 685, 800], 'landscape');
        return $studentBatchReportPdf->download('Batch No '.$batchStudent . '.' . 'pdf');
    }
    public function studentListDownloadFromBatchNumber($batchStudent)
    {
        $sql = AdmissionForm::with('moneyReceipt', 'user')->where('batch_no', $batchStudent);
        $admissionStudents = $sql->paginate(300);
        return view('backend.admin.pdf.batch-student-pdf', compact('admissionStudents'));
    }
    //====== For HR =========//

    public function showAdmissionDueModal($id)
    {
        $courseDueCollection = MoneyReceipt::with('admissionForm')->where('id', $id)->first();
        if (!$courseDueCollection){
            return redirect()->back()->with('error', 'Student not found');
        }
        return view('backend.admin.hrm.edit', compact('courseDueCollection'));
    }

    //====== For HR =========//

    public function adminShowAdmissionDueModal($id)
    {
        $courseDueCollection = MoneyReceipt::with('admissionForm')->where('id', $id)->first();
        if (!$courseDueCollection){
            return redirect()->back()->with('error', 'Student not found');
        }
        return view('backend.admin.student.edit', compact('courseDueCollection'));
    }

    public function dueClear(Request $request, $id)
    {
        //dd($request->is_pay);
        $this->validate($request, [
            'total_fee' => 'required',
            'due' => 'required',
            'is_pay' => 'required',
        ]);

        try {
            $dueClear = MoneyReceipt::where('id', $id)->first();
            $dueClear->due = $request->due;
            $dueClear->today_pay = $request->due_payment;
            if ($request->is_paid){
                $dueClear->is_pay = $request->is_pay;
            }else{
                $dueClear->is_pay = $request->is_pay;
            }
//            $dueClear->is_paid = $request->is_paid;
            $dueClear->save();
            //Student opinion
            $updateStudentNote = AdmissionForm::find($dueClear->admission_id);
            if ($request->note){
                $updateStudentNote->note = $request->note;
            }else{
                $updateStudentNote->note = $request->is_paid_note;
            }
            $updateStudentNote->save();
        }catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect('/admin/student/list')->with('success', 'Updated.');
    }

    //====== For Admin =========//
    public function adminDueClear(Request $request, $id)
    {
        $this->validate($request, [
            'total_fee' => 'required',
            'due' => 'required',
            'is_pay' => 'required',
        ]);

        try {
            $dueClear = MoneyReceipt::where('id', $id)->first();
            $dueClear->due = $request->due;
            $dueClear->today_pay = $request->due_payment;
            if ($request->is_paid){
                $dueClear->is_pay = $request->is_pay;
            }else{
                $dueClear->is_pay = $request->is_pay;
            }
//            $dueClear->is_paid = $request->is_paid;
            $dueClear->save();
            //Student opinion
            $updateStudentNote = AdmissionForm::find($dueClear->admission_id);
            if ($request->note){
                $updateStudentNote->note = $request->note;
            }else{
                $updateStudentNote->note = $request->is_paid_note;
            }
            $updateStudentNote->save();
        }catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect('/admin/students/list')->with('success', 'Updated.');
    }

    public function register()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('backend.admin.users.register', compact('users'));
    }

    public function createForm()
    {
        return view('backend.admin.users.create');
    }

    public function store(UserRegistrationRequest $request)
    {
        try {
            if ($request->file('avatar')){
                $file = $request->file('avatar');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $file->move('avatar/', $name);
            }
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name  = $request->last_name;
            $user->email      = $request->email;
            $user->phone      = $request->phone;
            $user->mac_address      = $request->mac_address;
            if ($request->file('avatar')){
                $user->avatar      = $name;
            }
            $user->password   = bcrypt($request->password);
            $user->save();
        }catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->withSuccess('User has been created.');
    }

    public function edit(User $user)
    {
        return view('backend.admin.users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        try {
            if($request->hasFile('avatar')){
                if($user->avatar && file_exists(public_path('avatar/'.$user->avatar))){
                    unlink(public_path('avatar/'.$user->avatar));
                }
                $name = time() . '.' . $request->avatar->getClientOriginalExtension();
                $request->avatar->move('avatar/', $name);
                $user->avatar = $name;
            }
            $user->first_name = $request->first_name;
            $user->last_name  = $request->last_name;
            $user->email      = $request->email;
            $user->phone      = $request->phone;
            $user->mac_address      = $request->mac_address;
            $user->save();
        }catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect('admin/register')->withSuccess('User has been updated.');
    }

    public function logout()
    {
        session()->flush();
        return redirect('admin/login')->withSuccess('You are logout.');
    }

    public function active(User $user)
    {
        $user->status = 0;
        $user->save();
        return redirect('admin/register')->withSuccess('User has been inactivated.');
    }

    public function inactive(User $user)
    {
        $user->status = 1;
        $user->save();
        return redirect('admin/register')->withSuccess('User has been activated.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('admin/register')->withSuccess('User has been deleted.');
    }

    public function onlineUser()
    {
        $users = User::orderBy('updated_at', 'desc')->get();
        return view('backend.admin.users.online', compact('users'));
    }

    public function attendanceLog()
    {
        $attendances = AttendanceLog::with('user')->orderByDesc('created_at')->paginate(20);
        return view('backend.admin.users.attendance-log', compact('attendances'));
    }

    public function attendanceSheetDownload()
    {
        return $this->excel->download(new AttendanceMultiSheetReport(2022), 'Attendance.xlsx');
    }

    public function batchCreateForm()
    {
        $batchList = Batch::get();
        return view('backend.admin.batch-create', compact('batchList'));
    }

    public function batchStore(Request $request)
    {
        $this->validate($request, [
            'course_name' => 'required',
            'batch_no' => 'required',
        ]);

        try {
            $addNewBatch = new Batch();
            $addNewBatch->course_name = $request->course_name;
            $addNewBatch->batch_no = trim($request->batch_no);
            $addNewBatch->save();
        }catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Add new batch');
    }

    public function batchDelete($id)
    {
        $deleteBatch = Batch::find($id);
        if (!$deleteBatch){
            return redirect()->back()->with('error', 'No Batch Found');
        }
        $deleteBatch->delete();
        return redirect()->back()->with('error', 'Batch has been deleted');
    }

    public function expanse()
    {
        $sql = Expance::orderBy('created_at', 'desc');
        $dateFrom = date('Y-m-d', strtotime(request()->expanse_date));
        $dateTo = date('Y-m-d', strtotime(request()->to_date));

        $fromDate = date('Y-m-d', strtotime(request()->from_date));
        $toDate = date('Y-m-d', strtotime(request()->to_date));

        if (isset(request()->from_date) && isset(request()->to_date)){
            $sql->whereDate('created_at', '>=', $fromDate)->whereDate('created_at','<=', $toDate);
        }

        if (isset(request()->expanse_date) && isset(request()->to_date) && isset(request()->bill_type)){
            $sql->whereDate('created_at', '>=', $dateFrom)->whereDate('created_at','<=', $dateTo)->where('bill_type', request()->bill_type);
        }
        if (isset(request()->user_id) && isset(request()->bill_type)){
            $userMobileBill = Expance::where('user_id', request()->user_id)->where('bill_type', request()->bill_type);
            $expanses = $userMobileBill->get();
            return view('backend.admin.home.expanse', compact('expanses'));
        }
        $expanses = $sql->get();
        return view('backend.admin.home.expanse', compact('expanses'));
    }

    public function admissionFiltering(){
        //dd(request()->from_date);
        $data = [
            'users' => User::orderBy('updated_at', 'desc')->get(),
            'todayAmounts' => MoneyReceipt::whereDate('created_at', Carbon::today())->paginate(200),
            'monthlyAmounts' => MoneyReceipt::whereMonth('created_at', date('m'))->paginate(200),
            'admissionStudentsBatch' => AdmissionForm::select(['batch_no', 'course'])->with('moneyReceipt')->orderByDesc('created_at')->get()->groupBy('batch_no'),
            'batch' => Batch::orderByDesc('created_at')->paginate(200),
        ];
        if (isset(request()->batch_no)){
            $sql = AdmissionForm::with('moneyReceipt', 'user')->orderByDesc('created_at');
            $sql->where('batch_no', request()->batch_no);

            $admissionStudents = $sql->get();
            return view('backend.admin.home.admission-filtering', compact('admissionStudents', 'data'));
        }
        if (isset(request()->batch_number) && isset(request()->month)){
            $sql = AdmissionForm::with('moneyReceipt', 'user')->orderByDesc('created_at');
            $sql->where('batch_no', request()->batch_number)->whereMonth('created_at', date('m', strtotime(request()->month)));

            $admissionMonthlyBatchWiseStudentsCount = $sql->get();
            return view('backend.admin.home.admission-filtering', compact('admissionMonthlyBatchWiseStudentsCount', 'data'));
        }
        if (isset(request()->from_date) && isset(request()->to_date)) {
            $sqlFiltering = MoneyReceipt::with('admissionForm')->orderBy('created_at', 'desc')
                ->whereDate('admission_date', '>=', request()->from_date)
                ->whereDate('admission_date', '<=', request()->to_date);

            $admissionStudentsDateFiltering = $sqlFiltering->get();
            return view('backend.admin.pdf.admission-filtering-list', compact('admissionStudentsDateFiltering', 'data'));
        }
        return view('backend.admin.home.admission-filtering', compact('data'));
    }

    public function admissionFilteringReportDownload($from, $to)
    {
        $sql = MoneyReceipt::with('admissionForm')->orderBy('created_at', 'desc');
        $sql->whereDate('admission_date', '>=', $from)->whereDate('admission_date', '<=', $to);

        $admissionStudentsDateFilteringDownload = $sql->paginate(200);
        $callReportPdf = \PDF::loadView('backend.admin.pdf.admission', compact('admissionStudentsDateFilteringDownload'))->setPaper([0, 0, 685, 800], 'landscape');
        return $callReportPdf->download('AdmissionReport' . '.' . 'pdf');
    }

    //=========== Salary information ==========//
    public function salary(){
        $employees = User::orderBy('id', 'desc')->get();
        $sql = Salary::with('user');
        if (isset(request()->month)){
            $sql->where('month', 'LIKE', '%'.request()->month.'%');
        }
        $salaries = $sql->get();
        return view('backend.admin.salary.salary', compact('employees', 'salaries'));
    }

    public function salaryPay(Request $request)
    {
        $this->validate($request, [
            'month' => 'required',
            'user_id' => 'required',
            'salary' => 'required',
        ]);
        $isSalaryPaid = Salary::where('month', strtolower($request->month))->where('user_id', $request->user_id)->first();
        if ($isSalaryPaid){
            return redirect()->back()->with('error', 'Salary already paid in this month');
        }else{
            $salary = new Salary();
            $salary->user_id = $request->user_id;
            $salary->month = $request->month;
            $salary->salary = $request->salary;
            $salary->save();
            return redirect('/admin/salary/list')->with('success', 'Salary has been added');
        }
    }

    //========= Student admission form update ===============//
    public function adminEditAdmissionForm($id)
    {
        $batchNumber = Batch::orderBy('created_at', 'desc')->get();
        $editAdmissionForm = AdmissionForm::with('moneyReceipt')->find($id);
        return view('backend.admin.student.edit-admission-form', compact('batchNumber', 'editAdmissionForm'));
    }

    public function adminAdmissionFormUpdate(AdmissionRequest $request, $id)
    {
        $updateAdmissionForm = AdmissionForm::find($id);

        if($request->hasFile('avatar')){
            if($updateAdmissionForm->avatar && file_exists(public_path('student/'.$updateAdmissionForm->avatar))){
                unlink(public_path('student/'.$updateAdmissionForm->avatar));
            }
            $name = time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move('student/', $name);
            $updateAdmissionForm->avatar = $name;
        }

        $updateAdmissionForm->s_name = $request->s_name;
        $updateAdmissionForm->s_email = $request->s_email;
        $updateAdmissionForm->f_name = $request->f_name;
        $updateAdmissionForm->m_name = $request->m_name;
        $updateAdmissionForm->s_phone = $request->s_phone;
        $updateAdmissionForm->f_phone = $request->f_phone;
        $updateAdmissionForm->dob = $request->dob;
        $updateAdmissionForm->profession = $request->profession;
        $updateAdmissionForm->gender = $request->gender;
        $updateAdmissionForm->blood_group = $request->blood_group;
        $updateAdmissionForm->qualification = $request->qualification;
        $updateAdmissionForm->nid = $request->nid;
        $updateAdmissionForm->fb_id = $request->fb_id;
        $updateAdmissionForm->reference = $request->reference;
        $updateAdmissionForm->present_address = $request->present_address;
        $updateAdmissionForm->course = $request->course;
        $updateAdmissionForm->batch_no = $request->batch_no;
        $updateAdmissionForm->batch_type = $request->batch_type;
        $updateAdmissionForm->class_shedule = $request->class_shedule;
        $updateAdmissionForm->class_time = $request->class_time;
        $updateAdmissionForm->other_admission = $request->other_admission;
        $updateAdmissionForm->other_admission_note = $request->other_admission_note;
        $updateAdmissionForm->save();

        if ($updateAdmissionForm){
            MoneyReceipt::where('admission_id', $updateAdmissionForm->id)->first()->delete();
            $moneyReceipt = new MoneyReceipt();
            $moneyReceipt->admission_id = $updateAdmissionForm->id;
            $moneyReceipt->payment_type = $request->payment_type;
            $moneyReceipt->transaction_id = $request->transaction_id;
            $moneyReceipt->admission_date = $request->admission_date;
            $moneyReceipt->in_word = $request->in_word;
            $moneyReceipt->total_fee = $request->total_fee;
            $moneyReceipt->advance = $request->advance;
            $moneyReceipt->due = $request->due;
            $moneyReceipt->save();
        }
        return redirect('/admin/students/list')->with('success', 'Admission successfully updated.');

    }

    public function studentDelete($id)
    {
        $studentDelete = AdmissionForm::with('moneyReceipt')->find($id);
        if (!$studentDelete){
            return redirect()->back()->with('error', 'Student information not found');
        }
        $studentDelete->delete();
        MoneyReceipt::where('admission_id', $studentDelete->id)->first()->delete();
        return redirect()->back()->with('success', 'Student has been permanently deleted');
    }


    //Due collect report
    public function dueCollectReport()
    {
        if (isset(request()->batch_no)){
            $sql = AdmissionForm::with('moneyReceipt', 'user')->orderByDesc('updated_at');
            $sql->where('batch_no', request()->batch_no);

            $admissionStudents = $sql->paginate(200);
            $batchs = Batch::orderByDesc('created_at')->paginate(200);
            return view('backend.admin.home.due-collect', compact('admissionStudents', 'batchs'));
        }

        if (isset(request()->from_date) && isset(request()->to_date)){
            $sql = AdmissionForm::with('moneyReceipt', 'user')->orderByDesc('updated_at');
            $sql->whereHas('moneyReceipt', function ($q){
                $q->whereDate('updated_at', '>=', request()->from_date)->whereDate('updated_at', '<=', request()->to_date)->where('is_pay', 1);
            });

            $admissionStudents = $sql->get();
            return view('backend.admin.home.due-collect-report', compact('admissionStudents'));
        }

        $admissionStudents = AdmissionForm::with('moneyReceipt', 'user')->orderByDesc('updated_at')->paginate(200);
        $batchs = Batch::orderByDesc('created_at')->paginate(200);
        return view('backend.admin.home.due-collect', compact('admissionStudents', 'batchs'));
    }

    //Admin dashboard action
    public function todayAdmissionAdvanceInfo()
    {
        $sqlFiltering = MoneyReceipt::with('admissionForm')->orderBy('created_at', 'desc')
            ->whereDate('admission_date', Carbon::today()->format('Y-m-d'));

        $admissionStudentsDateFiltering = $sqlFiltering->get();
        return view('backend.admin.pdf.today-admission-advance-list', compact('admissionStudentsDateFiltering'));
    }

    public function monthlyAdmissionAdvanceInfo()
    {
        $sqlFiltering = MoneyReceipt::with('admissionForm')->orderBy('created_at', 'desc')
            ->whereMonth('admission_date', Carbon::today()->format('m'));

        $admissionStudentsDateFiltering = $sqlFiltering->get();
        return view('backend.admin.pdf.today-admission-advance-list', compact('admissionStudentsDateFiltering'));
    }
    public function todayDueCollectInfo()
    {
        $sqlFiltering = MoneyReceipt::with('admissionForm')->orderBy('updated_at', 'desc')
            ->whereDate('updated_at', Carbon::today())->where('is_pay', 1);

        $admissionStudentsDateFiltering = $sqlFiltering->get();
        return view('backend.admin.pdf.today-due-collect-list', compact('admissionStudentsDateFiltering'));
    }

    public function monthlyDueCollectInfo()
    {
        $sqlFiltering = MoneyReceipt::with('admissionForm')->orderBy('updated_at', 'desc')
            ->whereMonth('updated_at', date('m'))->where('is_pay', 1);

        $admissionStudentsDateFiltering = $sqlFiltering->get();
        return view('backend.admin.pdf.monthly-due-collect-list', compact('admissionStudentsDateFiltering'));
    }

    public function todayAdmissionDue()
    {
        $sqlFiltering = MoneyReceipt::with('admissionForm')->orderBy('created_at', 'desc')
            ->whereDate('admission_date', Carbon::today()->format('Y-m-d'));

        $admissionStudentsDateFiltering = $sqlFiltering->get();
        return view('backend.admin.pdf.today-admission-due-list', compact('admissionStudentsDateFiltering'));
    }

    public function todayTotalExpanseInfo()
    {
        $todayTotalExpanseLists = Expance::with('user')->orderBy('created_at', 'desc')->whereDate('created_at', Carbon::today())->get();
        return view('backend.admin.pdf.today-total-expanse', compact('todayTotalExpanseLists'));
    }

    public function monthlyAdmissionDueInfo()
    {
        $sqlFiltering = MoneyReceipt::with('admissionForm')->orderBy('created_at', 'desc')
            ->whereMonth('admission_date', Carbon::today()->format('m'));

        $admissionStudentsDateFiltering = $sqlFiltering->get();
        return view('backend.admin.pdf.monthly-admission-due-list', compact('admissionStudentsDateFiltering'));
    }

    public function monthlyTotalExpanseInfo()
    {
        $monthTotalExpanseLists = Expance::with('user')->orderBy('created_at', 'desc')->whereMonth('created_at', Carbon::today()->format('m'))->get();
        return view('backend.admin.pdf.monthly-total-expanse-list', compact('monthTotalExpanseLists'));
    }

    public function totalDueInfo()
    {
        $sqlFiltering = MoneyReceipt::with('admissionForm')->orderBy('created_at', 'desc');

        $admissionStudentsTotalDue = $sqlFiltering->get();
        return view('backend.admin.pdf.total-due', compact('admissionStudentsTotalDue'));
    }

    public function totalCollectDueInfo()
    {
        $sqlFiltering = MoneyReceipt::with('admissionForm')->orderBy('updated_at', 'desc');

        $totalDueCollectLists = $sqlFiltering->get();
        return view('backend.admin.pdf.total-due-collect-list', compact('totalDueCollectLists'));
    }

    public function totalAdmissionAdvanceInfo()
    {
        $sqlFiltering = MoneyReceipt::with('admissionForm')->select(['admission_id', 'admission_date', 'total_fee', 'advance', 'due'])
            ->orderBy('created_at', 'desc')->whereHas('admissionForm', function ($q){
                $q->select(['id', 'course', 'batch_no', 's_name', 's_phone']);
            });

        $totalAdmissionAdvance = $sqlFiltering->get();
        return view('backend.admin.pdf.total-admission-advance', compact('totalAdmissionAdvance'));
    }

    public function totalExpanseInfo()
    {
        $todayExpanseLists = Expance::with('user')->orderBy('created_at', 'desc')->get();
        return view('backend.admin.pdf.total-expanse', compact('todayExpanseLists'));
    }

    public function totalMonthlyAdmAdmission()
    {
        $sqlFiltering = MoneyReceipt::with('admissionForm')->orderBy('created_at', 'desc')
            ->whereMonth('admission_date', Carbon::today()->format('m'))->whereHas('admissionForm', function ($q){
                $q->where('course', 'digital');
            });

        $admissionStudentsDateFiltering = $sqlFiltering->get();
        return view('backend.admin.pdf.monthly-adm-admission', compact('admissionStudentsDateFiltering'));
    }

    public function totalMonthlyWebAdmission()
    {
        $sqlFiltering = MoneyReceipt::with('admissionForm')->orderBy('created_at', 'desc')
            ->whereMonth('admission_date', Carbon::today()->format('m'))->whereHas('admissionForm', function ($q){
                $q->where('course', 'web');
            });

        $admissionStudentsDateFiltering = $sqlFiltering->get();
        return view('backend.admin.pdf.monthly-web-admission', compact('admissionStudentsDateFiltering'));
    }

    public function totalMonthlyEngAdmission()
    {
        $sqlFiltering = MoneyReceipt::with('admissionForm')->orderBy('created_at', 'desc')
            ->whereMonth('admission_date', Carbon::today()->format('m'))->whereHas('admissionForm', function ($q){
                $q->where('course', 'english');
            });

        $admissionStudentsDateFiltering = $sqlFiltering->get();
        return view('backend.admin.pdf.monthly-eng-admission', compact('admissionStudentsDateFiltering'));
    }

    public function totalMonthlyAdmissionList()
    {
        $sqlFiltering = MoneyReceipt::with('admissionForm')->orderBy('created_at', 'desc')
            ->whereMonth('admission_date', Carbon::today()->format('m'));

        $admissionStudentsDateFiltering = $sqlFiltering->get();
        return view('backend.admin.pdf.total-monthly-admission', compact('admissionStudentsDateFiltering'));
    }

    protected $excel;
    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function adminStudentListImport($batchNo)
    {
        return $this->excel->download(new BatchWiseStudentMultipleSheet($batchNo), 'BatchStudentList.xlsx');
    }
}
