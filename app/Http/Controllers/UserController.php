<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdmissionRequest;
use App\Models\AdmissionForm;
use App\Models\Intereste;
use App\Models\MoneyReceipt;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\CashFlow\Constant\Periodic\Interest;
use Auth;
use Hash;

class UserController extends Controller
{
    public function userLoginForm()
    {
        return view('backend.users.auth.login');
    }
    public function todayTask()
    {
        $todayTask = Task::where('user_id', auth()->check() ? auth()->user()->id : '')->whereDate('created_at', Carbon::today())->get();
        //dd($todayTask);
        return view('backend.users.task.today-task', compact('todayTask'));
    }
    public function viewDetails($id)
    {
        $task = Task::find($id);
        return view('backend.users.task.view-details', compact('task'));
    }
    public function profileSetting()
    {
        return view('backend.users.profile.profile-setting');
    }
    public function allTask()
    {
        $allTask = Task::where('user_id', auth()->check() ? auth()->user()->id : '')->paginate(20);
        return view('backend.users.task.all-task', compact('allTask'));
    }

    public function interestStore(Request $request)
    {
        $this->validate($request, [
            'interest_level' => 'required'
        ]);
        $intereste = new Intereste();
        $intereste->task_id = $request->task_id;
        $intereste->interest_level = $request->interest_level;
        if ($request->select_course){
            $intereste->select_course = $request->select_course;
        }

        if ($request->batch_number){
            $intereste->batch_number = $request->batch_number;
        }

        if ($request->note){
            $intereste->note = $request->note;
        }
        $intereste->save();
        //========= Task Table update query ===============//
        $task = Task::where('id', $request->task_id)->first();
        $task->status = 1;
        $task->save();

        return redirect('/today/task')->withSuccess('Information updated.');
    }
    public function pendingTask(){
        $pendingTask = Task::where('user_id', auth()->check() ? auth()->user()->id : '')->where('status', 0)->orderBy('created_at', 'desc')->get();
        return view('backend.users.task.pending-task', compact('pendingTask'));
    }

    public function confirmAddmission(){
        $complete = Intereste::with('task')->where('interest_level', 'done')->whereHas('task', function ($q){
            $q->where('user_id', auth()->check() ? auth()->user()->id : '');
        })->get();
        return view('backend.users.task.confirm-addmission', compact('complete'));
    }

    public function notInterested(){
        $notInterested = Intereste::where('interest_level' , 'not')->whereHas('task', function ($q){
            $q->where('user_id', auth()->check() ? auth()->user()->id : '');
        })->get();
        return view('backend.users.task.not-interested', compact('notInterested'));
    }

    public function highlyInterested(){
        $highlyInterested = Intereste::where('interest_level' , 'highly')->whereHas('task', function ($q){
            $q->where('user_id', auth()->check() ? auth()->user()->id : '');
        })->get();
        return view('backend.users.task.highly-interested' , compact('highlyInterested'));
    }

    public function interested(){
        $interested = Intereste::where('interest_level' , '50%')->whereHas('task', function ($q){
            $q->where('user_id', auth()->check() ? auth()->user()->id : '');
        })->get();
        return view('backend.users.task.interested' , compact('interested'));
    }
    public function others(){
        $others = Intereste::where('interest_level' , 'others')->whereHas('task', function ($q){
            $q->where('user_id', auth()->check() ? auth()->user()->id : '');
        })->get();
        return view('backend.users.task.others' , compact('others'));
    }

    public function addmissionForm(){
        return view('backend.users.task.addmission-form');
    }
    public function moneyReceipt(){
        return view('backend.users.task.money-receipt');
    }
    public function addmissionList(){
        return view('backend.users.task.addmission-list');
    }

    //============= Update information ================//
    public function updateInformation($id)
    {
        $interest = Intereste::with('task')->find($id);
        if ($interest == null){
            return redirect()->back();
        }
        return view('backend.users.task.edit', compact('interest'));
    }

    public function profileUpdate($id)
    {
        $profileUpdate = User::find($id);
        if(request()->hasFile('avatar')){
            if($profileUpdate->avatar && file_exists(public_path('avatar/'.$profileUpdate->avatar))){
                unlink(public_path('avatar/'.$profileUpdate->avatar));
            }
            $name = time() . '.' . request()->avatar->getClientOriginalExtension();
            request()->avatar->move('avatar/', $name);
            $profileUpdate->avatar = $name;
        }
        $profileUpdate->first_name = request()->first_name;
        $profileUpdate->last_name = request()->last_name;
        $profileUpdate->phone = request()->phone;
        $profileUpdate->phone = request()->phone;
        $profileUpdate->save();
        return redirect()->back()->withSuccess('Profile has been updated');
    }

    public function passwordUpdate(Request $request, $id)
    {
        //dd(auth()->user()->password);
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;
        //dd($hashedPassword);
        if (\Hash::check($request->old_password , $hashedPassword )) {

            if (!\Hash::check($request->password , $hashedPassword)) {

                $users = User::find(Auth::user()->id);
                $users->password = bcrypt($request->password);
                User::where( 'id' , Auth::user()->id)->update( array( 'password' =>  $users->password));

                session()->flash('success','password updated successfully');
                return redirect()->back();
            }

            else{
                session()->flash('error','new password can not be the old password!');
                return redirect()->back();
            }

        }

        else{
            session()->flash('error','old password doesnt matched ');
            return redirect()->back();
        }

    }

    public function admissionStore(AdmissionRequest $request)
    {
        if ($request->file('avatar')){
            $file = $request->file('avatar');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('student/', $name);
        }

        $newStudent = new AdmissionForm();
        $newStudent->user_id = auth()->user()->id;
        $newStudent->s_name = $request->s_name;
        $newStudent->s_email = $request->s_email;
        $newStudent->f_name = $request->f_name;
        $newStudent->m_name = $request->m_name;
        $newStudent->s_phone = $request->s_phone;
        $newStudent->f_phone = $request->f_phone;
        $newStudent->dob = $request->dob;
        $newStudent->profession = $request->profession;
        $newStudent->gender = $request->gender;
        $newStudent->blood_group = $request->blood_group;
        $newStudent->qualification = $request->qualification;
        $newStudent->nid = $request->nid;
        $newStudent->present_address = $request->present_address;
        $newStudent->permanent_address = $request->permanent_address;
        $newStudent->course = $request->course;
        $newStudent->batch_no = $request->batch_no;
        $newStudent->batch_type = $request->batch_type;
        $newStudent->class_shedule = $request->class_shedule;
        $newStudent->class_time = $request->class_time;
        if ($request->file('avatar')){
            $newStudent->avatar      = $name;
        }
        $newStudent->save();

        if ($newStudent){
            $moneyReceipt = new MoneyReceipt();
            $moneyReceipt->admission_id = $newStudent->id;
            $moneyReceipt->payment_type = $request->payment_type;
            $moneyReceipt->admission_date = $request->admission_date;
            $moneyReceipt->in_word = $request->in_word;
            $moneyReceipt->total_fee = $request->total_fee;
            $moneyReceipt->advance = $request->advance;
            $moneyReceipt->due = $request->due;
            $moneyReceipt->save();
        }
        return redirect()->back()->with('success', 'Admission successfully done.');
    }
}
