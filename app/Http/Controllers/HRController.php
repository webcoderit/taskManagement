<?php

namespace App\Http\Controllers;

use App\Models\AdmissionForm;
use App\Models\Batch;
use Illuminate\Http\Request;

class HRController extends Controller
{
    public function editAdmissionForm($id)
    {
        $batchNumber = Batch::orderBy('created_at', 'desc')->get();
        $editAdmissionForm = AdmissionForm::find($id);
        return view('backend.admin.hrm.edit-admission-form', compact('batchNumber', 'editAdmissionForm'));
    }

    public function hrProfileShow()
    {

    }
}
