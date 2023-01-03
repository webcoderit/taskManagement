<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdmissionRequest;
use App\Mail\AdmissionConfirmationEmail;
use App\Models\AdmissionForm;
use App\Models\Batch;
use App\Models\Intereste;
use App\Models\MoneyReceipt;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\CashFlow\Constant\Periodic\Interest;
use Auth;
use Hash;

class UserController extends Controller
{
    public function userLoginForm()
    {
        return view('backend.users.auth.login');
    }
    public function todayTask()
    {
        $sql = Task::where('user_id', auth()->check() ? auth()->user()->id : '')->whereDate('created_at', Carbon::today());
        if (isset(request()->search)){
            $sql->where('phone', request()->search)->orWhere('name',request()->search);
        }
        $todayTask = $sql->paginate(50);
        //dd($todayTask);
        return view('backend.users.task.today-task', compact('todayTask'));
    }
    public function viewDetails($id)
    {
        $task = Task::find($id);
        return view('backend.users.task.view-details', compact('task'));
    }
    public function profileSetting()
    {
        return view('backend.users.profile.profile-setting');
    }
    public function allTask()
    {
        $sql = Task::with('interestes')->where('user_id', auth()->check() ? auth()->user()->id : '')->orderBy('updated_at', 'ASC');
        if (isset(request()->search)){
            $sql->where('phone', request()->search)->orWhere('name', request()->search);
        }
        $allTask = $sql->paginate(50);
        //dd($allTask);
        return view('backend.users.task.all-task', compact('allTask'));
    }

    public function interestStore(Request $request)
    {
        $this->validate($request, [
            'interest_level' => 'required'
        ]);
        $checkInterested = Intereste::where('task_id', $request->task_id)->first();
        if ($checkInterested){
            $interesteUpdated = Intereste::find($checkInterested->id);
            $interesteUpdated->task_id = $request->task_id;
            $interesteUpdated->interest_level = $request->interest_level;
            if ($request->select_course){
                $interesteUpdated->select_course = $request->select_course;
            }

            if ($request->batch_number){
                $interesteUpdated->batch_number = $request->batch_number;
            }

            if ($request->note){
                $interesteUpdated->note = $request->note;
            }
            if ($request->address){
                $interesteUpdated->address = $request->address;
            }
            if ($request->profession){
                $interesteUpdated->profession = $request->profession;
            }
            $interesteUpdated->save();
            //========= Task Table update query ===============//
            $task = Task::where('id', $request->task_id)->first();
            $task->status = 1;
            $task->save();


            if ($interesteUpdated->interest_level == 'done'){
                return redirect('/addmission/form')->withSuccess('Student Admission Successfully. Please filled up the form.');
            }elseif ($interesteUpdated->interest_level == 'highly'){
                return redirect('/highly/interested')->withSuccess('Highly interested, Ready for Recall.');
            }elseif ($interesteUpdated->interest_level == '50%'){
                return redirect('/interested')->withSuccess('Interested, Ready for Recall.');
            }elseif ($interesteUpdated->interest_level == 'not'){
                return redirect('/not/interested')->withSuccess('Not Interested');
            }else{
                return redirect('/others')->withSuccess('Recall list');
            }
        }else{
            $intereste = new Intereste();
            $intereste->task_id = $request->task_id;
            $intereste->interest_level = $request->interest_level;
            if ($request->select_course){
                $intereste->select_course = $request->select_course;
            }

            if ($request->batch_number){
                $intereste->batch_number = $request->batch_number;
            }

            if ($request->note){
                $intereste->note = $request->note;
            }

            if ($request->address){
                $intereste->address = $request->address;
            }
            if ($request->profession){
                $intereste->profession = $request->profession;
            }

            $intereste->save();
            //========= Task Table update query ===============//
            $task = Task::where('id', $request->task_id)->first();
            $task->status = 1;
            $task->save();

            if ($intereste->interest_level == 'done'){
                return redirect('/addmission/form')->withSuccess('Student Admission Successfully. Please filled up the form.');
            }elseif ($intereste->interest_level == 'highly'){
                return redirect('/highly/interested')->withSuccess('Highly interested, Ready for Recall.');
            }elseif ($intereste->interest_level == '50%'){
                return redirect('/interested')->withSuccess('Interested, Ready for Recall.');
            }elseif ($intereste->interest_level == 'not'){
                return redirect('/not/interested')->withSuccess('Not Interested');
            }else{
                return redirect('/others')->withSuccess('Recall list');
            }
        }
    }
    public function pendingTask(){
         $sql = Task::where('user_id', auth()->check() ? auth()->user()->id : '')->where('status', 0)->orderBy('updated_at', 'desc');
        if (isset(request()->search)){
            $sql->where('phone', request()->search)->orWhere('name',request()->search);
        }
        $pendingTask = $sql->paginate(50);
        return view('backend.users.task.pending-task', compact('pendingTask'));
    }

    public function confirmAddmission(){
         $sql = AdmissionForm::with('user', 'moneyReceipt')->where('user_id', auth()->user()->id)->orderByDesc('created_at');
        if (isset(request()->search)){
            $sql->where('batch_no', request()->search);
        }
        $complete = $sql->paginate(50);
        return view('backend.users.task.confirm-addmission', compact('complete'));
    }

    public function notInterested(){
        $notInterested = Intereste::where('interest_level' , 'not')->whereHas('task', function ($q){
            $q->where('user_id', auth()->check() ? auth()->user()->id : '');
        })->orderByDesc('updated_at')->paginate(50);
        return view('backend.users.task.not-interested', compact('notInterested'));
    }

    public function highlyInterested(){
        $highlyInterested = Intereste::where('interest_level' , 'highly')->whereHas('task', function ($q){
            $q->where('user_id', auth()->check() ? auth()->user()->id : '');
        })->orderByDesc('updated_at')->paginate(50);
        return view('backend.users.task.highly-interested' , compact('highlyInterested'));
    }

    public function interested(){
        $interested = Intereste::where('interest_level' , '50%')->whereHas('task', function ($q){
            $q->where('user_id', auth()->check() ? auth()->user()->id : '');
        })->orderByDesc('updated_at')->paginate(50);
        return view('backend.users.task.interested' , compact('interested'));
    }
    public function others(){
        $others = Intereste::where('interest_level', 'others')->whereHas('task', function ($q){
            $q->where('user_id', auth()->check() ? auth()->user()->id : '');
        })->orderByDesc('updated_at')->paginate(50);
        return view('backend.users.task.others' , compact('others'));
    }

    public function addmissionForm(){
        $batchNumber = Batch::orderBy('created_at', 'desc')->paginate(50);
        return view('backend.users.task.addmission-form', compact('batchNumber'));
    }
    public function moneyReceipt(){
        $sql = AdmissionForm::with('moneyReceipt')->orderBy('created_at', 'desc')->where('user_id', auth()->user()->id);
        if (isset(request()->search)){
            $sql->where('batch_no', request()->search);
        }
        $moneyReceipt = $sql->paginate(50);
        return view('backend.users.task.money-receipt', compact('moneyReceipt'));
    }
    public function addmissionList(){
        $sql = AdmissionForm::with('moneyReceipt')->orderBy('created_at', 'desc')->where('user_id', auth()->user()->id);
        if (isset(request()->search) && isset(auth()->user()->id)){
            $sql->where('batch_no', request()->search);
        }

        $admissionForms = $sql->paginate(50);
        return view('backend.users.task.addmission-list', compact('admissionForms'));
    }
    public function moneyReceiptView($id){
        $moneyReceiptView = MoneyReceipt::with('admissionForm')->where('admission_id', $id)->first();
        if (!$moneyReceiptView){
            return redirect()->back()->with('error', 'No money receipt found');
        }
        return view('backend.users.task.money-receipt-view' , compact('moneyReceiptView'));
    }
    public function admissionFormView($id){
        $admissionForm = AdmissionForm::with('moneyReceipt')->where('id' , $id)->first();
        if (!$admissionForm){
            return redirect()->back()->with('error', 'No admission form found');
        }
        return view('backend.users.task.admission-form-view' , compact('admissionForm'));
    }
    public function admissionFormPdf(){
        return view('backend.users.task.admission-form-pdf');
    }
    public function moneyReceiptPdf(){
        return view('backend.users.task.money-receipt-pdf');
    }

    public function communityChat(){
        return view('backend.users.task.chat');
    }

    //============= Update information ================//
    public function updateInformation($id)
    {
        $interest = Intereste::with('task')->find($id);
        if ($interest == null){
            return redirect()->back();
        }
        return view('backend.users.task.edit', compact('interest'));
    }

    public function profileUpdate($id)
    {
        $profileUpdate = User::find($id);
        if(request()->hasFile('avatar')){
            if($profileUpdate->avatar && file_exists(public_path('avatar/'.$profileUpdate->avatar))){
                unlink(public_path('avatar/'.$profileUpdate->avatar));
            }
            $name = time() . '.' . request()->avatar->getClientOriginalExtension();
            request()->avatar->move('avatar/', $name);
            $profileUpdate->avatar = $name;
        }
        $profileUpdate->first_name = request()->first_name;
        $profileUpdate->last_name = request()->last_name;
        $profileUpdate->phone = request()->phone;
        $profileUpdate->phone = request()->phone;
        $profileUpdate->save();
        return redirect()->back()->withSuccess('Profile has been updated');
    }

    public function passwordUpdate(Request $request, $id)
    {
        //dd(auth()->user()->password);
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;
        //dd($hashedPassword);
        if (\Hash::check($request->old_password , $hashedPassword )) {

            if (!\Hash::check($request->password , $hashedPassword)) {

                $users = User::find(Auth::user()->id);
                $users->password = bcrypt($request->password);
                User::where( 'id' , Auth::user()->id)->update( array( 'password' =>  $users->password));

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

    }

    public function admissionStore(AdmissionRequest $request)
    {
        \DB::transaction(function() use($request){
            try {
                if ($request->file('avatar')){
                    $file = $request->file('avatar');
                    $name = time() . '.' . $file->getClientOriginalExtension();
                    $file->move('student/', $name);
                }

                $newStudent = new AdmissionForm();
                $newStudent->user_id = auth()->user()->id ?? session()->get('id');
                $lastInvoiceID = $newStudent->orderBy('id', 'desc')->pluck('id')->first();
                if (!$lastInvoiceID){
                    $newStudent->student_id = 1;
                }else{
                    $newStudent->student_id = $lastInvoiceID + 1;
                }
                $newStudent->s_name = $request->s_name;
                $newStudent->s_email = $request->s_email;
                $newStudent->f_name = $request->f_name;
                $newStudent->m_name = $request->m_name;
                $newStudent->s_phone = $request->s_phone;
                $newStudent->f_phone = $request->f_phone;
                $newStudent->dob = $request->dob;
                $newStudent->profession = $request->profession;
                $newStudent->gender = $request->gender;
                $newStudent->blood_group = $request->blood_group;
                $newStudent->qualification = $request->qualification;
                $newStudent->nid = $request->nid;
                $newStudent->fb_id = $request->fb_id;
                if ($request->fb_id_two){
                    $newStudent->fb_id_two = $request->fb_id_two;
                }
                $newStudent->reference = $request->reference;
                $newStudent->present_address = $request->present_address;
                $newStudent->course = $request->course;
                $newStudent->batch_no = $request->batch_no;
                $newStudent->batch_type = $request->batch_type;
                $newStudent->class_shedule = $request->class_schedule;
                $newStudent->class_time = $request->class_time;
                $newStudent->other_admission = $request->other_admission;
                $newStudent->other_admission_note = $request->other_admission_note;
                if ($request->file('avatar')){
                    $newStudent->avatar      = $name;
                }
                $newStudent->save();

                if ($newStudent){
                    $moneyReceipt = new MoneyReceipt();
                    $moneyReceipt->admission_id = $newStudent->id;
                    $moneyReceipt->payment_type = $request->payment_type;
                    $moneyReceipt->transaction_id = $request->transaction_id;
                    $moneyReceipt->admission_date = $request->admission_date;
                    $moneyReceipt->in_word = $request->in_word;
                    $moneyReceipt->total_fee = $request->total_fee;
                    $moneyReceipt->advance = $request->advance;
                    $moneyReceipt->online_charge = $request->online_charge;
                    $moneyReceipt->due = $request->due;

                    $moneyReceipt->save();


                    $pdf = PDF::loadView('backend.users.task.money-receipt-pdf', compact('moneyReceipt'));
                    $email = $request->s_email;
                    Mail::send('backend.users.task.money-receipt-pdf',  [
                        's_name'              => $request->s_name,
                        's_email'             => $request->s_email,
                        'f_name'            => $request->f_name,
                        's_phone'             => $request->s_phone,
                        'batch_no'   => $request->batch_no,
                        'course' => $request->course,
                        'batch_type'               => $request->batch_type,
                        'class_shedule'    => $request->class_shedule,
                        'class_time'   => $request->class_time,
                        'admission_date'            => $request->admission_date,
                        'total_fee'      => $request->total_fee,
                        'advance'              => $request->advance,
                        'due'         => $request->due,
                    ],
                        function ($msg) use ($email, $pdf){
                            $msg->from('info@webcoder-it.com', 'Webcoder-IT');
                            $msg->subject('Subject: Admission confirmation email');
                            $msg->attachData($pdf->output(), "Receipt.pdf");
                            $msg->to($email);
                        });
                }

//                if ($newStudent->save() && $moneyReceipt->save()){
//                    Mail::to($newStudent->s_email)->send(new AdmissionConfirmationEmail($moneyReceipt));
//                }

                return response()->json([
                    'status' => 200,
                    'message' => 'Admission has been successfully added.'
                ]);
            }
            catch (\Exception $exception){
                return response()->json([
                  'status' => 500,
                  'error' => $exception->getMessage(),
                ]);
            }
        });
    }

    //=================== PDF Download ======================//
    public function admissionPdfDownload($id)
    {
        $data = [
            'moneyReceipt' => MoneyReceipt::with('admissionForm')->where('id', $id)->first()
        ];
        $moneyReceiptPdf = PDF::loadView('backend.users.task.money-receipt-pdf', compact('data'))->setPaper([0, 0, 350, 685], 'landscape');
        return $moneyReceiptPdf->download($data['moneyReceipt']->admissionForm->s_name . '.' . 'pdf');

    }

    public function paidMoneyReceiptDownload($id)
    {
        $data = [
            'moneyReceipt' => MoneyReceipt::with('admissionForm')->where('admission_id', $id)->first()
        ];
        return view('backend.users.task.paid-money-receipt-pdf', compact('data'));
//        $moneyReceiptPdf = PDF::loadView('backend.users.task.paid-money-receipt-pdf', compact('data'))->setPaper([0, 0, 350, 685], 'landscape');
//        return $moneyReceiptPdf->download($data['moneyReceipt']->admissionForm->s_name . '.' . 'pdf');

    }

    public function admissionFormPdfDownload($id)
    {
        $data = [
            'admissionForm' => AdmissionForm::with('moneyReceipt')->where('id' , $id)->first()
        ];
        $admissionFormPdf = PDF::loadView('backend.users.task.admission-form-pdf', compact('data'))->setPaper([0, 0, 685, 800], 'landscape');
        return $admissionFormPdf->download($data['admissionForm']->s_name . '.' . 'pdf');
    }

}
