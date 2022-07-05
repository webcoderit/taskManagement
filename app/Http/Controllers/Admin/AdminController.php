<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AttendanceMultiSheetReport;
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
    protected $excel;
    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

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
                }else{
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
        
        $users = User::orderBy('updated_at', 'desc')->get();
        $todayCredit = MoneyReceipt::whereDate('admission_date', Carbon::today())->get()->sum('advance');
        $todayDue = MoneyReceipt::whereDate('admission_date', Carbon::today())->get()->sum('due');
        $monthlyCredit = MoneyReceipt::whereMonth('admission_date', date('m'))->get()->sum('advance');
        $monthlyDebit = MoneyReceipt::whereMonth('admission_date', date('m'))->get()->sum('due');
        $totalDue = MoneyReceipt::get()->sum('due');
        $admissionChats = AdmissionForm::select(\DB::raw("COUNT(*) as count"), \DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(\DB::raw("Month(created_at)"))
            ->pluck('count', 'month_name');

        $labels = $admissionChats->keys();
        $data = $admissionChats->values();
        return view('backend.admin.home.index', compact('users', 'todayCredit', 'todayDue', 'monthlyCredit', 'monthlyDebit', 'totalDue', 'labels', 'data'));
    }

    public function hr_dashboard()
    {
        $data = [
            'users' => User::orderBy('updated_at', 'desc')->get(),

            'todayAmounts' => MoneyReceipt::with('admissionForm')->whereDate('admission_date', Carbon::today())->get(),

            'monthlyAmounts' => MoneyReceipt::with('admissionForm')->whereMonth('admission_date', date('m'))->get(),

            'monthlyWebAdmission' => MoneyReceipt::with('admissionForm')->whereHas('admissionForm', function ($q){
                $q->where('course', 'web');
            })->whereMonth('admission_date', date('m'))->get(),

            'monthlyAdmAdmission' => MoneyReceipt::with('admissionForm')->whereHas('admissionForm', function ($q){
                $q->where('course', 'digital');
            })->whereMonth('admission_date', date('m'))->get(),

            'monthlyEngAdmission' => MoneyReceipt::with('admissionForm')->whereHas('admissionForm', function ($q){
                $q->where('course', 'english');
            })->whereMonth('admission_date', date('m'))->get(),

            'admissionStudentsBatch' => AdmissionForm::with('moneyReceipt')->orderByDesc('created_at')->get()->groupBy('batch_no'),
        ];
        $sql = AdmissionForm::with('moneyReceipt', 'user')->orderByDesc('created_at');

        if (isset(request()->user_id) && isset(request()->date)&& isset(request()->batch_no)){
            $sql->where('user_id', 'LIKE','%'.request()->user_id.'%')->whereHas('moneyReceipt', function ($date){
                $date->where('admission_date', 'LIKE', '%'.request()->date.'%');
            })->where('batch_no', 'LIKE', '%'.request()->batch_no.'%');
            $admissionStudents = $sql->get();
            return view('backend.admin.hrm.index', compact( 'data', 'admissionStudents'));
        }
        $admissionStudents = '';
        $totalDue = MoneyReceipt::get()->sum('due');
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
        $admissionStudents = $sql->paginate(50);
        $data = [
            'admissionStudentsBatch' => AdmissionForm::with('moneyReceipt')->orderByDesc('created_at')->get()->groupBy('batch_no')
        ];
        return view('backend.admin.student.student-list', compact('admissionStudents', 'data'));
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
        $this->validate($request, [
            'total_fee' => 'required',
            'advance' => 'required',
            'due' => 'required',
        ]);

        try {
            $dueClear = MoneyReceipt::where('id', $id)->first();
            $dueClear->advance = $dueClear->advance + $request->due_payment;
            $dueClear->due = $request->due;
            $dueClear->today_pay = $request->due_payment;
            $dueClear->save();
            //Student opinion
            $updateStudentNote = AdmissionForm::find($dueClear->admission_id);
            $updateStudentNote->note = $request->note;
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
            'advance' => 'required',
            'due' => 'required',
        ]);

        try {
            $dueClear = MoneyReceipt::where('id', $id)->first();
            $dueClear->advance = $dueClear->advance + $request->due_payment;
            $dueClear->due = $request->due;
            $dueClear->today_pay = $request->due_payment;
            $dueClear->save();
            //Student opinion
            $updateStudentNote = AdmissionForm::find($dueClear->admission_id);
            $updateStudentNote->note = $request->note;
            $updateStudentNote->save();
        }catch (\Exception $exception){
            return redirect('/admin/students/list')->with('error', $exception->getMessage());
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
        $data = [
            'users' => User::orderBy('updated_at', 'desc')->get(),
            'todayAmounts' => MoneyReceipt::whereDate('created_at', Carbon::today())->get(),
            'monthlyAmounts' => MoneyReceipt::whereMonth('created_at', date('m'))->get(),
            'admissionStudentsBatch' => AdmissionForm::with('moneyReceipt')->orderByDesc('created_at')->get()->groupBy('batch_no'),
            'batch' => Batch::orderByDesc('created_at')->get(),
        ];
        if (isset(request()->batch_no) && isset(request()->month)){
            $sql = AdmissionForm::with('moneyReceipt', 'user')->orderByDesc('created_at');
            $sql->where('batch_no', request()->batch_no)->orWhereMonth('created_at', request()->month);

            $admissionStudents = $sql->get();
            return view('backend.admin.home.admission-filtering', compact('admissionStudents', 'data'));
        }
        if (isset(request()->from_date) && isset(request()->to_date)) {
            $sqlFiltering = MoneyReceipt::with('admissionForm')->orderBy('created_at', 'desc')
                ->whereDate('admission_date', '>=', request()->from_date)
                ->whereDate('admission_date', '<=', request()->to_date);

            $admissionStudentsDateFiltering = $sqlFiltering->get();
            return view('backend.admin.home.admission-filtering', compact('admissionStudentsDateFiltering', 'data'));
        }
        return view('backend.admin.home.admission-filtering', compact('data'));
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
            if($updateAdmissionForm->avatar && file_exists(public_path('avatar/'.$updateAdmissionForm->avatar))){
                unlink(public_path('avatar/'.$updateAdmissionForm->avatar));
            }
            $name = time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move('avatar/', $name);
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
}
