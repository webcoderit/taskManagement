<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expance;
use Illuminate\Http\Request;

class ExpanseController extends Controller
{
    public function expanse(){
        $expanses = Expance::paginate(50);
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
}
