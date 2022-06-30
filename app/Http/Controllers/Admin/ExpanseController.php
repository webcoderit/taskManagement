<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expance;
use App\Models\Salary;
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
        $expanses = $sql->get();
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
            'bill_type' => 'required',
        ]);

        try {
            $expanse = new Expance();
            $expanse->bill_type = $request->bill_type;
            $expanse->price = $request->price;
            $expanse->note = $request->note;
            $expanse->save();
            return redirect('/expanse')->with('success', 'Expanse has been added');
        }catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function editExpanse($id)
    {
        $expanse = Expance::find($id);
        return view('backend.admin.hrm.edit-expanse', compact('expanse'));
    }

    public function updateExpanse(Request $request, $id)
    {
        $this->validate($request, [
            'price' => 'required',
            'note' => 'required',
            'bill_type' => 'required',
        ]);

        $expanse = Expance::find($id);
        $expanse->bill_type = $request->bill_type;
        $expanse->price = $request->price;
        $expanse->note = $request->note;
        $expanse->save();
        return redirect('/expanse')->with('success', 'Expanse has been updated');
    }

    public function deleteExpanse($id)
    {
        $expanse = Expance::find($id);
        $expanse->delete();
        return redirect('/expanse')->with('success', 'Expanse has been deleted');
    }

    public function salary(){
        $employees = User::orderBy('id', 'desc')->get();
        $sql = Salary::with('user');
        if (isset(request()->month)){
            $sql->where('month', 'LIKE', '%'.request()->month.'%');
        }
        $salaries = $sql->get();
        return view('backend.admin.hrm.salary', compact('employees', 'salaries'));
    }

    public function salaryPay(Request $request)
    {
        $this->validate($request, [
            'month' => 'required',
            'user_id' => 'required',
            'salary' => 'required',
        ]);
        $isSalaryPaid = Salary::where('month', strtolower($request->month))->where('user_id', $request->user_id)->first();
        if ($isSalaryPaid){
            return redirect()->back()->with('error', 'Salary already paid in this month');
        }else{
            $salary = new Salary();
            $salary->user_id = $request->user_id;
            $salary->month = $request->month;
            $salary->salary = $request->salary;
            $salary->save();
            return redirect('/salary')->with('success', 'Salary has been added');
        }
    }
}
