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
        \DB::transaction(function() use($request, $id){
            try {
                $updateAdmissionForm = AdmissionForm::find($id);

                if($request->hasFile('avatar')){
                    if($updateAdmissionForm->avatar && file_exists(public_path('student/'.$updateAdmissionForm->avatar))){
                        unlink(public_path('student/'.$updateAdmissionForm->avatar));
                    }
                    $name = time() . '.' . $request->avatar->getClientOriginalExtension();
                    $request->avatar->move('student/', $name);
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
                $updateAdmissionForm->fb_id = $request->fb_id;
                $updateAdmissionForm->reference = $request->reference;
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
            }catch (\Exception $exception){
                return redirect()->back()->with('error', $exception->getMessage());
            }
        });

        return redirect('/admin/student/list')->with('success', 'Admission successfully updated.');

    }

    public function studentList(){
        $sql = AdmissionForm::with('moneyReceipt', 'user')->orderByDesc('created_at')->where('is_reject', 0);
        if (isset(request()->batch_no)){
            $sql->where('batch_no', 'LIKE','%'.request()->batch_no.'%');
        }
        if (isset(request()->phone)){
            $sql->where('s_phone', 'LIKE','%'.request()->phone.'%');
        }
        $admissionStudents = $sql->paginate(50);
        $data = [
            'admissionStudentsBatch' => AdmissionForm::with('moneyReceipt')->orderByDesc('created_at')->get()->groupBy('batch_no')
        ];
        return view('backend.admin.hrm.student-list', compact('admissionStudents', 'data'));
    }

    public function rejectStudent($id)
    {
        $rejectStudent = AdmissionForm::where('id', $id)->first();
        $rejectStudent->is_reject = 1;
        if ($rejectStudent->save()){
            $rejectStudentMoneyReceipt = MoneyReceipt::with('admissionForm')->where('admission_id', $id)->first();
            $rejectStudentMoneyReceipt->is_reject = 1;
            $rejectStudentMoneyReceipt->save();
        }
        return redirect()->back()->with('success', 'Student move to rejected list');
    }

    public function rejectStudentList()
    {
        $admissionRejectStudents = AdmissionForm::with('moneyReceipt')->where('is_reject', 1)->get();
        return view('backend.admin.hrm.student-reject-list', compact('admissionRejectStudents'));
    }

    public function paidStudentList()
    {
        $admissionPaidStudents = AdmissionForm::with('moneyReceipt')
            ->whereHas('moneyReceipt', function ($q){
                $q->where('due', 0);
            })
            ->get();
        return view('backend.admin.hrm.student-paid-list', compact('admissionPaidStudents'));
    }

    public function admissionForm()
    {
        $batchNumber = Batch::orderBy('created_at', 'desc')->get();
        return view('backend.admin.hrm.addmission-form', compact('batchNumber'));
    }

    public function allMoneyReceipt()
    {
        $moneyReceipt = AdmissionForm::with('moneyReceipt')->orderBy('created_at', 'desc')->get();
        return view('backend.admin.hrm.money-receipt', compact('moneyReceipt'));
    }

    public function viewMoneyReceipt($id){
        $moneyReceiptView = MoneyReceipt::with('admissionForm')->where('admission_id', $id)->first();
        if (!$moneyReceiptView){
            return redirect()->back()->with('error', 'No money receipt found');
        }
        return view('backend.admin.hrm.money-receipt-view' , compact('moneyReceiptView'));
    }

    public function admissionCheck(Request $request)
    {
        if ($request->admin_check == null){
            return redirect()->back()->with('error', 'Please select minimum one number.');
        }
        $admissionCheck = AdmissionForm::whereIn('id', $request->admin_check)->get();
        //return $admissionCheck;
        foreach ($admissionCheck as $key => $check){
            $check->admin_check = $request->admin_check[$key];
            $check->save();
        }
        return redirect()->back()->with('success', 'Your information has been updated.');
    }

    public function studentDelete($id)
    {
        $studentDelete = AdmissionForm::with('moneyReceipt')->find($id);
        if (!$studentDelete){
            return redirect()->back()->with('error', 'Student information not found');
        }
        $studentDelete->delete();
        //MoneyReceipt::where('admission_id', $studentDelete->id)->first()->delete();
        return redirect()->back()->with('success', 'Student has been deleted');
    }
}
