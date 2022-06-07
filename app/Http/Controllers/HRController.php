<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdmissionRequest;
use App\Models\Admin;
use App\Models\AdmissionForm;
use App\Models\Batch;
use App\Models\MoneyReceipt;
use Illuminate\Http\Request;
use Hash;
class HRController extends Controller
{
    public function editAdmissionForm($id)
    {
        $batchNumber = Batch::orderBy('created_at', 'desc')->get();
        $editAdmissionForm = AdmissionForm::with('moneyReceipt')->find($id);
        return view('backend.admin.hrm.edit-admission-form', compact('batchNumber', 'editAdmissionForm'));
    }

    public function hrProfileShow()
    {
        $hrProfileUpdate = Admin::where('type', 'hr')->first();
        return view('backend.admin.hrm.profile', compact('hrProfileUpdate'));
    }

    public function hrProfileUpdate(Request $request, $id)
    {
        try {
            $updateProfile = Admin::where('id', $id)->first();
            $updateProfile->name = $request->name;
            $updateProfile->email = $request->email;
            $updateProfile->save();
        }catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }

        return redirect()->back()->with('success', 'Profile has been updated');
    }

    public function hrProfilePasswordUpdate(Request $request, $id)
    {
        try {
            $hashedPassword = Admin::find($id);
            if (\Hash::check($request->old_password , $hashedPassword->password )) {

                if (!\Hash::check($request->password , $hashedPassword->password)) {

                    $hr = Admin::find($hashedPassword->id);
                    $hr->password = bcrypt($request->password);
                    Admin::where( 'id' , $hashedPassword->id)->update( array( 'password' =>  $hr->password));

                    session()->flash('success','password updated successfully');
                    return redirect()->back();
                }

                else{
                    session()->flash('error','new password can not be the old password!');
                    return redirect()->back();
                }

            }

            else{
                session()->flash('error','old password doesnt matched ');
                return redirect()->back();
            }
        }catch (\Exception $exception){

        }
    }

    public function admissionFormUpdate(AdmissionRequest $request, $id)
    {
        $updateAdmissionForm = AdmissionForm::find($id);

        if($request->hasFile('avatar')){
            if($updateAdmissionForm->avatar && file_exists(public_path('avatar/'.$updateAdmissionForm->avatar))){
                unlink(public_path('avatar/'.$updateAdmissionForm->avatar));
            }
            $name = time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move('avatar/', $name);
            $updateAdmissionForm->avatar = $name;
        }

        $updateAdmissionForm->s_name = $request->s_name;
        $updateAdmissionForm->s_email = $request->s_email;
        $updateAdmissionForm->f_name = $request->f_name;
        $updateAdmissionForm->m_name = $request->m_name;
        $updateAdmissionForm->s_phone = $request->s_phone;
        $updateAdmissionForm->f_phone = $request->f_phone;
        $updateAdmissionForm->dob = $request->dob;
        $updateAdmissionForm->profession = $request->profession;
        $updateAdmissionForm->gender = $request->gender;
        $updateAdmissionForm->blood_group = $request->blood_group;
        $updateAdmissionForm->qualification = $request->qualification;
        $updateAdmissionForm->nid = $request->nid;
        $updateAdmissionForm->present_address = $request->present_address;
        $updateAdmissionForm->course = $request->course;
        $updateAdmissionForm->batch_no = $request->batch_no;
        $updateAdmissionForm->batch_type = $request->batch_type;
        $updateAdmissionForm->class_shedule = $request->class_shedule;
        $updateAdmissionForm->class_time = $request->class_time;
        $updateAdmissionForm->other_admission = $request->other_admission;
        $updateAdmissionForm->other_admission_note = $request->other_admission_note;
        $updateAdmissionForm->save();

        if ($updateAdmissionForm){
            MoneyReceipt::where('admission_id', $updateAdmissionForm->id)->first()->delete();
            $moneyReceipt = new MoneyReceipt();
            $moneyReceipt->admission_id = $updateAdmissionForm->id;
            $moneyReceipt->payment_type = $request->payment_type;
            $moneyReceipt->admission_date = $request->admission_date;
            $moneyReceipt->in_word = $request->in_word;
            $moneyReceipt->total_fee = $request->total_fee;
            $moneyReceipt->advance = $request->advance;
            $moneyReceipt->due = $request->due;
            $moneyReceipt->save();
        }
        return redirect('/admin/student/list')->with('success', 'Admission successfully updated.');

    }
}
