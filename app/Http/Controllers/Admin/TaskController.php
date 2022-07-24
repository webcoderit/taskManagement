<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Imports\ImportUser;
use App\Imports\TaskImport;
use App\Models\AdmissionForm;
use App\Models\AssignNumber;
use App\Models\Intereste;
use App\Models\MoneyReceipt;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class TaskController extends Controller
{
    public function listTask()
    {
        $page = '';
        if (isset(request()->task_date)){
            $page = 'task_date';
            $tasksDateFiltering = Task::with('user')->whereDate('created_at', request()->task_date);
            $tasks = $tasksDateFiltering->get()->groupBy('user_id');
            return view('backend.admin.task.index', compact('tasks', 'page'));
        }
        $tasks = Task::with('user')->whereDate('created_at', Carbon::today())->get()->groupBy('user_id');
        return view('backend.admin.task.index', compact('tasks', 'page'));
    }

    public function allTaskView($id)
    {
        $tasks = Task::with('user')->where('status', 0)->where('user_id', $id)->get();

        if (isset(request()->from_date) && isset(request()->to_date)) {
            $sqlFiltering = Task::with('user')->where('status', 0)->where('user_id', $id)
                ->whereDate('created_at', '>=', request()->from_date)
                ->whereDate('created_at', '<=', request()->to_date);

            $tasks = $sqlFiltering->get();
            return view('backend.admin.task.view', compact('tasks', 'id'));
        }

        return view('backend.admin.task.view', compact('tasks', 'id'));
    }

    public function addTask()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('backend.admin.task.create', compact('users'));
    }

    public function excel_store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|integer'
        ]);
        $file = $request->file('files');
        if ($file == null){
            return redirect()->back()->with('error', 'Please insert a valid file.');
        }else{
            Excel::import(new ImportUser, $file);
        }
        return back()->withSuccess('Data imported.');
    }

    public function allTask()
    {
        $tasks = Task::with('user')->get()->groupBy('user_id');
        return view('backend.admin.task.all-task', compact('tasks'));
    }
    public function pendingTask(Request $request)
    {
//        $sql = Task::with('user')->where('status', 0);
//        if (isset($request->user_id)){
//            $sql->whereHas('user', function($q) use($request){
//                $q->where('id', 'LIKE','%'.$request->user_id.'%');
//            });
//        }
//        $pendingTasks = $sql->paginate(10);
//        $users = User::all();
        $pendingTasks = Task::with('user')->get()->where('status', 0)->groupBy('user_id');
        return view('backend.admin.task.pending-task', compact('pendingTasks'));
    }

    public function completeAddmission(Request $request)
    {
        $sql = AdmissionForm::with('moneyReceipt', 'user')->orderByDesc('created_at');
        if (isset($request->user_id) && isset($request->month)){
            $sql->where('user_id', $request->user_id)->whereHas('moneyReceipt', function ($q) use ($request){
                $q->whereMonth('admission_date',  date('m', strtotime($request->month)));
            });
        }
        $complete = $sql->paginate(100);
        $users = User::all();
        return view('backend.admin.task.confirm-addmission' , compact('complete', 'users'));
    }
    public function notInterested(Request $request)
    {
        $sql = Intereste::with('task')->where('interest_level' , 'not')->orderByDesc('created_at');
        if (isset($request->user_id) && isset($request->month)){
            $sql->whereHas('task', function ($q) use ($request){
                $q->where('user_id', $request->user_id)->whereMonth('created_at',  date('m', strtotime($request->month)));
            });
        }
        $notInterested = $sql->paginate(100);
        $users = User::all();
        return view('backend.admin.task.not-interested' , compact('notInterested', 'users'));
    }
    public function highlyInterested(Request $request)
    {
        $sql = Intereste::where('interest_level' , 'highly');
        if (isset($request->user_id) && isset($request->month)){
            $sql->whereHas('task', function ($q) use ($request){
                $q->where('user_id', $request->user_id)->whereMonth('created_at',  date('m', strtotime($request->month)));
            });
        }
        $highlyInterested = $sql->paginate(100);
        $users = User::all();
        return view('backend.admin.task.highly-interested' , compact('highlyInterested', 'users'));
    }
    public function interested(Request $request)
    {
        $sql = Intereste::where('interest_level' , '50%');
        if (isset($request->user_id) && isset($request->month)){
            $sql->whereHas('task', function ($q) use ($request){
                $q->where('user_id', $request->user_id)->whereMonth('created_at',  date('m', strtotime($request->month)));
            });
        }
        $interested = $sql->paginate(100);
        $users = User::all();
        return view('backend.admin.task.interested' , compact('interested', 'users'));
    }
    public function recall(Request $request)
    {
        $sql = Intereste::where('interest_level', '!=', 'done');
        if (isset($request->user_id) && isset($request->month)){
            $sql->whereHas('task', function ($q) use ($request){
                $q->where('user_id', $request->user_id)->whereMonth('created_at',  date('m', strtotime($request->month)));
            });
        }
        $recalls = $sql->paginate(100);
        $users = User::all();
        return view('backend.admin.task.recall', compact('recalls', 'users'));
    }
    public function taskFiltering(){
        $data = [
            'users' => User::orderBy('updated_at', 'desc')->get(),
            'todayAmounts' => MoneyReceipt::whereDate('created_at', Carbon::today())->get(),
            'monthlyAmounts' => MoneyReceipt::whereMonth('created_at', date('m'))->get(),
            'admissionStudentsBatch' => AdmissionForm::with('moneyReceipt')->orderByDesc('created_at')->get()->groupBy('batch_no'),
        ];
        $sql = AdmissionForm::with('moneyReceipt', 'user')->orderByDesc('created_at');
        if (isset(request()->user_id) && isset(request()->date) && isset(request()->batch_no)){
            //dd(request()->date);
            $sql->where('user_id', 'LIKE','%'.request()->user_id.'%')->whereHas('moneyReceipt', function ($date){
                $date->where('admission_date', 'LIKE', '%'.request()->date.'%');
            })->where('batch_no', 'LIKE', '%'.request()->batch_no.'%');
        }
        $admissionStudents = $sql->get();
        return view('backend.admin.task.task-filtering', compact('admissionStudents', 'data'));
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
        if (!$task){
            return redirect()->back()->with('error', 'No task found');
        }
        $users = User::orderBy('created_at', 'desc')->get();
        return view('backend.admin.task.edit', compact('task', 'users'));
    }

    public function taskUpdate(TaskRequest $request, $id)
    {
        try {
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
        }catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->withSuccess('Task has been updated');
    }

    public function taskDelete($id)
    {
        $taskDelete = Task::find($id);
        if (!$taskDelete){
            return redirect()->back()->with('error', 'No task found');
        }
        $taskDelete->delete();
        return redirect()->back()->withError('Task has been deleted');
    }


    //=============================== Call report download ========================================//
    public function callReportDownload($month, $user_id)
    {
        $sql = AdmissionForm::with('moneyReceipt', 'user')->where('user_id', $user_id)
            ->whereMonth('created_at', date('m', strtotime($month)))
            ->orderByDesc('created_at');
        $reports = $sql->get();
        $callReportPdf = \PDF::loadView('backend.admin.pdf.report', compact('reports'))->setPaper([0, 0, 685, 800], 'landscape');
        return $callReportPdf->download('Report' . '.' . 'pdf');
    }
}
