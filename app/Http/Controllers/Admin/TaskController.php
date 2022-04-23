<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Imports\ImportUser;
use App\Imports\TaskImport;
use App\Models\AssignNumber;
use App\Models\Intereste;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\CashFlow\Constant\Periodic\Interest;
use PhpParser\Node\Stmt\TryCatch;

class TaskController extends Controller
{
    public function listTask()
    {
        $tasks = Task::with('user')->whereDate('created_at', Carbon::today())->get();
        return view('backend.admin.task.index', compact('tasks'));
    }

    public function addTask()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('backend.admin.task.create', compact('users'));
    }

    public function excel_store(Request $request)
    {
        $this->validate($request, [
            'files' => 'required',
            'user_id' => 'required|integer'
        ]);
        $file = $request->file('files');
        Excel::import(new ImportUser, $file);
        return back()->withSuccess('Excel imported.');
    }

    public function allTask()
    {
        $tasks = Task::with('user')->get();
        return view('backend.admin.task.all-task', compact('tasks'));
    }
    public function pendingTask()
    {
        return view('backend.admin.task.pending-task');
    }

//    public function taskStore(TaskRequest $request)
//    {
//        try {
//            $newTask = new Task();
//            $newTask->user_id = $request->user_id;
//            $newTask->name = $request->name;
//            if ($request->fb_id){
//                $newTask->fb_id = $request->fb_id;
//            }
//            if ($request->address){
//                $newTask->address = $request->address;
//            }
//            if ($request->email){
//                $newTask->email = $request->email;
//            }
//            if ($request->device){
//                $newTask->device = $request->device;
//            }
//            if ($request->profession){
//                $newTask->profession = $request->profession;
//            }
//            $newTask->save();
//
//
//            //============ Number assign =================//
//            foreach ($request->phone as $key => $number){
//                $phone = new AssignNumber();
//                $phone->task_id = $newTask->id;
//                $phone->phone = $request->phone[$key];
//                $phone->save();
//            }
//
//            return redirect()->back()->withSuccess('Task has been assigned');
//        }catch (\Exception $exception){
//            return redirect()->back()->with('error', $exception->getMessage());
//        }
//    }

    public function taskEdit($id)
    {
        $task = Task::find($id);
        $users = User::orderBy('created_at', 'desc')->get();
        return view('backend.admin.task.edit', compact('task', 'users'));
    }

    public function taskUpdate(TaskRequest $request, $id)
    {
        $taskUpdate = Task::find($id);
        $taskUpdate->user_id = $request->user_id;
        $taskUpdate->name = $request->name;
        $taskUpdate->email = $request->email;
        $taskUpdate->fb_id = $request->fb_id;
        $taskUpdate->address = $request->address;
        $taskUpdate->device = $request->device;
        $taskUpdate->phone = $request->phone;
        $taskUpdate->profession = $request->profession;
        $taskUpdate->save();
        return redirect()->back()->withSuccess('Task has been updated');
    }

    public function taskDelete($id)
    {
        $taskDelete = Task::find($id);
        $taskDelete->delete();
        return redirect()->back()->withError('Task has been deleted');
    }
    public function completeAddmission()
    {
        $complete = Intereste::with('task')->where('interest_level', 'done')->get();
        return view('backend.admin.task.confirm-addmission' , compact('complete'));
    }
    public function notInterested()
    {
        $notInterested = Intereste::where('interest_level' , 'not')->get();
        return view('backend.admin.task.not-interested' , compact('notInterested'));
    }
    public function highlyInterested()
    {
        $highlyInterested = Intereste::where('interest_level' , 'highly')->get();
        return view('backend.admin.task.highly-interested' , compact('highlyInterested'));
    }
    public function interested()
    {
        $interested = Intereste::where('interest_level' , '50%')->get();
        return view('backend.admin.task.interested' , compact('interested'));
    }
    public function recall()
    {
        return view('backend.admin.task.recall');
    }
}
