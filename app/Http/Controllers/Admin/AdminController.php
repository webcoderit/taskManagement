<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AttendanceMultiSheetReport;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Admin;
use App\Models\AdmissionForm;
use App\Models\AttendanceLog;
use App\Models\Batch;
use App\Models\Expance;
use App\Models\Intereste;
use App\Models\MoneyReceipt;
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
        $todayCredit = MoneyReceipt::whereDate('created_at', Carbon::today())->get()->sum('advance');
        $todayDue = MoneyReceipt::whereDate('created_at', Carbon::today())->get()->sum('due');
        $monthlyCredit = MoneyReceipt::whereMonth('created_at', date('m'))->get()->sum('advance');
        $monthlyDebit = MoneyReceipt::whereMonth('created_at', date('m'))->get()->sum('due');
        $totalDue = MoneyReceipt::get()->sum('due');
        return view('backend.admin.home.index', compact('users', 'todayCredit', 'todayDue', 'monthlyCredit', 'monthlyDebit', 'totalDue'));
    }

    public function hr_dashboard()
    {
        $users = User::orderBy('updated_at', 'desc')->get();
        $todayCredit = MoneyReceipt::whereDate('created_at', Carbon::today())->get()->sum('advance');
        $todayDue = MoneyReceipt::whereDate('created_at', Carbon::today())->get()->sum('due');
        $monthlyDueCollect = MoneyReceipt::whereMonth('created_at', date('m'))->get()->sum('today_pay');
        $monthlyDebit = MoneyReceipt::whereMonth('created_at', date('m'))->get()->sum('due');
        $todayDueCollect = MoneyReceipt::whereDate('updated_at', Carbon::today())->get()->sum('today_pay');
        $admissionStudentsBatch = AdmissionForm::with('moneyReceipt')->orderByDesc('created_at')->get()->groupBy('batch_no');
        $sql = AdmissionForm::with('moneyReceipt', 'user')->orderByDesc('created_at');
        if (isset(request()->user_id) && isset(request()->date)&& isset(request()->batch_no)){
            $sql->where('user_id', 'LIKE','%'.request()->user_id.'%')->whereHas('moneyReceipt', function ($date){
                $date->where('admission_date', 'LIKE', '%'.request()->date.'%');
            })->where('batch_no', 'LIKE', '%'.request()->batch_no.'%');
        }
        $admissionStudents = $sql->paginate(50);
        return view('backend.admin.hrm.index', compact('users', 'todayCredit', 'todayDue', 'monthlyDueCollect', 'monthlyDebit', 'todayDueCollect', 'admissionStudentsBatch', 'admissionStudents'));
    }

    public function studentList(){
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
        return view('backend.admin.hrm.student-list', compact('admissionStudents', 'data'));
    }

    public function showAdmissionDueModal($id)
    {
        $courseDueCollection = MoneyReceipt::with('admissionForm')->where('id', $id)->first();
        return view('backend.admin.hrm.edit', compact('courseDueCollection'));
    }

    public function dueClear(Request $request, $id)
    {
        $this->validate($request, [
            'total_fee' => 'required',
            'advance' => 'required',
            'due' => 'required',
        ]);

        $dueClear = MoneyReceipt::where('id', $id)->first();
        $dueClear->advance = $dueClear->advance + $request->due_payment;
        $dueClear->due = $request->due;
        $dueClear->today_pay = $request->due_payment;
        $dueClear->save();
        //Student opinion
        $updateStudentNote = AdmissionForm::find($dueClear->admission_id);
        $updateStudentNote->note = $request->note;
        $updateStudentNote->save();
        return redirect('/admin/student/list')->with('success', 'Updated.');
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
        return redirect()->back()->withSuccess('User has been created.');
    }

    public function edit(User $user)
    {
        return view('backend.admin.users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
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

        $addNewBatch = new Batch();
        $addNewBatch->course_name = $request->course_name;
        $addNewBatch->batch_no = trim($request->batch_no);
        $addNewBatch->save();
        return redirect()->back()->with('success', 'Add new batch');
    }

    public function batchDelete($id)
    {
        $deleteBatch = Batch::find($id);
        $deleteBatch->delete();
        return redirect()->back()->with('error', 'Batch has been deleted');
    }

    public function expanse()
    {
        $sql = Expance::orderBy('created_at', 'desc');
        $dateFormat = date('Y-m-d', strtotime(request()->expanse_date));
        if (isset(request()->expanse_date)){
            $sql->where('created_at', 'LIKE', '%'. $dateFormat.'%');
        }
        $expanses = $sql->paginate(50);
        return view('backend.admin.home.expanse', compact('expanses'));
    }

    public function admissionFiltering(){
        return view('backend.admin.home.admission-filtering');
    }
}
