<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userLoginForm()
    {
        return view('backend.users.auth.login');
    }
    public function todayTask()
    {
        return view('backend.users.task.today-task');
    }
    public function viewDetails()
    {
        return view('backend.users.task.view-details');
    }
}
