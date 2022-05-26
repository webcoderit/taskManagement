<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expance;
use App\Models\User;
use Illuminate\Http\Request;

class ExpanseController extends Controller
{
    public function expanse(){
        $sql = Expance::orderBy('created_at', 'desc');
        $dateFormat = date('Y-m-d', strtotime(request()->expanse_date));
        if (isset(request()->expanse_date)){
            $sql->where('created_at', 'LIKE', '%'. $dateFormat.'%');
        }
        $expanses = $sql->paginate(50);
        return view('backend.admin.hrm.expanse', compact('expanses'));
    }

    public function addExpanse(){
        return view('backend.admin.hrm.add-expanse');
    }

    public function addNewExpanse(Request $request)
    {
        $this->validate($request, [
            'price' => 'required',
            'note' => 'required',
        ]);

        $expanse = new Expance();
        $expanse->price = $request->price;
        $expanse->note = $request->note;
        $expanse->save();
        return redirect('/expanse')->with('success', 'Expanse has been added');
    }

    public function salary(){
        $employees = User::orderBy('id', 'desc')->get();
        return view('backend.admin.hrm.salary', compact('employees'));
    }
    public function salaryPay(){
        return view('backend.admin.hrm.salary-pay');
    }
    public function salaryAdvance(){
        return view('backend.admin.hrm.salary-advance');
    }
}
