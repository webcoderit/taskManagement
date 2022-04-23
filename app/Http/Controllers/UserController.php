<?php

namespace App\Http\Controllers;

use App\Models\Intereste;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\CashFlow\Constant\Periodic\Interest;

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
        $pendingTask = Task::where('user_id', auth()->user()->id)->where('status', 0)->orderBy('created_at', 'desc')->get();
        return view('backend.users.task.pending-task', compact('pendingTask'));
    }

    public function confirmAddmission(){
        $complete = Intereste::with('task')->where('interest_level', 'done')->get();
        return view('backend.users.task.confirm-addmission', compact('complete'));
    }

    public function notInterested(){
        $notInterested = Intereste::where('interest_level' , 'not')->get();
        return view('backend.users.task.not-interested', compact('notInterested'));
    }

    public function highlyInterested(){
        $highlyInterested = Intereste::where('interest_level' , 'highly')->get();
        return view('backend.users.task.highly-interested' , compact('highlyInterested'));
    }

    public function interested(){
        $interested = Intereste::where('interest_level' , '50%')->get();
        return view('backend.users.task.interested' , compact('interested'));
    }
    public function others(){
        $others = Intereste::where('interest_level' , 'others')->get();
        return view('backend.users.task.others' , compact('others'));
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
}
