<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userLoginForm()
    {
        return view('backend.users.auth.login');
    }
}
