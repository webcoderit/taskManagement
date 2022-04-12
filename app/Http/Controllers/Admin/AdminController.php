<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Session;
class AdminController extends Controller
{
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
            return redirect()->back()->withError('Email does not match');
        }
    }

    public function deshboard()
    {
        return view('backend.admin.home.index');
    }
    public function register()
    {
        return view('backend.admin.home.index');
    }
}
