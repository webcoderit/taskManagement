<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AttendanceMultiSheetReport;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Admin;
use App\Models\AttendanceLog;
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
                return redirect('/admin/dashboard');
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
}
