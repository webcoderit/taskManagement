<?php

namespace App\Http\Controllers;

use App\Models\Intereste;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    public function profile()
    {
        return view('backend.users.profile.profile');
    }
    public function profileSetting()
    {
        return view('backend.users.profile.profile-setting');
    }
    public function allTask()
    {
        return view('backend.users.task.all-task');
    }

    public function interestStore(Request $request)
    {
        $this->validate($request, [
            'interest_level' => 'required'
        ]);
        $intereste = new Intereste();
        $intereste->task_id = $request->task_id;
        $intereste->interest_level = $request->interest_level;
        if ($request->note){
            $intereste->note = $request->note;
        }
        $intereste->save();
        //========= Task Table update query ===============//
        $task = Task::where('id', $request->task_id)->first();
        $task->status = 1;
        $task->save();

        return redirect()->back()->withSuccess('Information updated.');
    }

    public function completeTask(){
        return view('backend.users.task.complete-task');
    }

    public function pendingTask(){
        return view('backend.users.task.pending-task');
    }

    public function confirmAddmission(){
        return view('backend.users.task.confirm-addmission');
    }

    public function notInterested(){
        return view('backend.users.task.not-interested');
    }

    public function highlyInterested(){
        return view('backend.users.task.highly-interested');
    }

    public function interested(){
        return view('backend.users.task.interested');
    }
}
