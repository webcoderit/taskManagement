<?php

namespace App\Http\Controllers;

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
}
