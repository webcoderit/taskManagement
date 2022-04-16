<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\AssignNumber;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class TaskController extends Controller
{
    public function listTask()
    {
        $tasks = Task::with('user', 'number')->whereDate('created_at', Carbon::today())->get();
        return view('backend.admin.task.index', compact('tasks'));
    }

    public function addTask()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('backend.admin.task.create', compact('users'));
    }

    public function allTask()
    {
        return view('backend.admin.task.all-task');
    }
    public function completeTask()
    {
        return view('backend.admin.task.complete-task');
    }
    public function pendingTask()
    {
        return view('backend.admin.task.pending-task');
    }

    public function taskStore(TaskRequest $request)
    {
        try {
            $newTask = new Task();
            $newTask->user_id = $request->user_id;
            $newTask->name = $request->name;
            if ($request->fb_id){
                $newTask->fb_id = $request->fb_id;
            }
            if ($request->address){
                $newTask->address = $request->address;
            }
            if ($request->email){
                $newTask->email = $request->email;
            }
            if ($request->device){
                $newTask->device = $request->device;
            }
            if ($request->profession){
                $newTask->profession = $request->profession;
            }
            $newTask->save();


            //============ Number assign =================//
            foreach ($request->phone as $key => $number){
                $phone = new AssignNumber();
                $phone->task_id = $newTask->id;
                $phone->phone = $request->phone[$key];
                $phone->save();
            }

            return redirect()->back()->withSuccess('Task has been assigned');
        }catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function taskDelete($id)
    {
        $taskDelete = Task::find($id);
        $taskDelete->delete();
        return redirect()->back()->withError('Task has been deleted');
    }
    public function confirmAddmission()
    {
        return view('backend.admin.task.confirm-addmission');
    }
    public function notInterested()
    {
        return view('backend.admin.task.not-interested');
    }
    public function highlyInterested()
    {
        return view('backend.admin.task.highly-interested');
    }
    public function interested()
    {
        return view('backend.admin.task.interested');
    }
    public function recall()
    {
        return view('backend.admin.task.recall');
    }
}
