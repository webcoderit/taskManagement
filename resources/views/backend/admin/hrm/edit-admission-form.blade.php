@extends('backend.admin.hr-master')

@section('content')
    <section class="student-addmission-form-section">
        <div class="container">
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ Session::get('success') }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-md-10 m-auto">
                    <div class="addmission-form-wrapper">
                        <div class="addmission-form-heading">
                            <div class="addmission-list-btn-outer">
                                <a href="{{ url('admin/student/list') }}" class="addmission-list-btn-inner">Back</a>
                            </div>
                            <h2 class="institute-name">Web<span>coder</span>-it</h2>
                            <address>
                                House#06, Level#03 Road-1/A, Sector#09 Housebuilding, Uttara Dhaka-1230
                            </address>
                            <span>
                                <a href="tel:01648177071">
                                    01648177071 ,
                                </a>
                            </span>
                            <span>
                                <a href="tel:01814812233">
                                    01814812233
                                </a>
                            </span><br>
                            <span>
                                <a href="https://webcoder-it.com/" target="_blank" title="Website">
                                    www.webcoder-it.com ,
                                </a>
                            </span>
                            <span>
                                <a href="mailto:webcoderit@gmail.com" title="Gmail Id">
                                    webcoderit@gmail.com
                                </a>
                            </span>
                        </div>
                        <h4 class="addmission-form-title">
                            Student Information
                        </h4>
                        <form class="form-group addmission-form" action="{{ url('/admission/update/'.$editAdmissionForm->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="student_name">Student Name</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="s_name" value="{{ $editAdmissionForm->s_name }}" placeholder="Student Name" class="form-control">
                                    <span style="color: red"> {{ $errors->has('s_name') ? $errors->first('s_name') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email</label><br>
                                    <input type="email" name="s_email" value="{{ $editAdmissionForm->s_email }}" placeholder="Student Email" class="form-control">
                                    <span style="color: red"> {{ $errors->has('s_email') ? $errors->first('s_email') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="father_name">Father's Name</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="f_name" value="{{ $editAdmissionForm->f_name }}" placeholder="Father Name" class="form-control">
                                    <span style="color: red"> {{ $errors->has('f_name') ? $errors->first('f_name') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="mother_name">Mother's Name</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="m_name" value="{{ $editAdmissionForm->m_name }}" placeholder="Mother Name" class="form-control">
                                    <span style="color: red"> {{ $errors->has('m_name') ? $errors->first('m_name') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="student_phone">Student Phone No.</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="tel" name="s_phone" value="{{ $editAdmissionForm->s_phone }}" placeholder="Student Phone No." class="form-control">
                                    <span style="color: red"> {{ $errors->has('s_phone') ? $errors->first('s_phone') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="father_phone">Father Phone No.</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="tel" name="f_phone" value="{{ $editAdmissionForm->f_phone }}" placeholder="Father Phone No." class="form-control">
                                    <span style="color: red"> {{ $errors->has('f_phone') ? $errors->first('f_phone') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="birth_date">Date Of Birth</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="date" name="dob" value="{{ $editAdmissionForm->dob }}" placeholder="Date Of Birth" class="form-control">
                                    <span style="color: red"> {{ $errors->has('dob') ? $errors->first('dob') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="profession">Profession</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="profession" value="{{ $editAdmissionForm->profession }}" placeholder="Student Profession" class="form-control">
                                    <span style="color: red"> {{ $errors->has('profession') ? $errors->first('profession') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="gender">Gender</label><span style="color: red; font-size: 16px;"> *</span>
                                    <div class="d-flex align-items-center gender">
                                        <input type="radio" id="male" name="gender" value="Male" {{ $editAdmissionForm->gender == 'Male' ? 'checked' : '' }} />
                                        <label for="male">Male</label><br>
                                        <input type="radio" id="female" name="gender" value="Female" {{ $editAdmissionForm->gender == 'Female' ? 'checked' : '' }} />
                                        <label for="female">Female</label><br>
                                        <input type="radio" id="others" name="gender" value="Others" {{ $editAdmissionForm->gender == 'Others' ? 'checked' : '' }} />
                                        <label for="others">Others</label>
                                        <span style="color: red"> {{ $errors->has('gender') ? $errors->first('gender') : ' ' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="blood_group">Blood Group</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="blood_group" value="{{ $editAdmissionForm->blood_group }}" placeholder="Blood Group " class="form-control">
                                    <span style="color: red"> {{ $errors->has('blood_group') ? $errors->first('blood_group') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="qualificaton">Educational Qualification</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="qualification" value="{{ $editAdmissionForm->blood_group }}" placeholder="Educational Qualifications" class="form-control">
                                    <span style="color: red"> {{ $errors->has('qualification') ? $errors->first('qualification') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="nid_birth_no">NID/Birth Certificate No.</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="number" name="nid" value="{{ $editAdmissionForm->nid }}" placeholder="NID/Birth Certificate No." class="form-control">
                                    <span style="color: red"> {{ $errors->has('nid') ? $errors->first('nid') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="student_fb_name">Student FB Name/ FB Link</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="fb_id" value="{{ $editAdmissionForm->fb_id ? $editAdmissionForm->fb_id : old('fb_id') }}" placeholder="Student FB Name or ID" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="student_fb_name">Student 2nd FB Link</label><br>
                                    <input type="text" name="fb_id_two" value="{{ $editAdmissionForm->fb_id_two ? $editAdmissionForm->fb_id_two : old('fb_id_two') }}" placeholder="Student 2nd FB ID" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="student_ref_name">Student Reference Name</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="reference" value="{{ $editAdmissionForm->reference ? $editAdmissionForm->reference : old('reference') }}" placeholder="Student Reference Name" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="present_address">Address</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <textarea name="present_address" rows="2" cols="50" class="form-control">{{ $editAdmissionForm->present_address }}</textarea>
                                    <span style="color: red"> {{ $errors->has('present_address') ? $errors->first('present_address') : ' ' }}</span>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label>Other Admission</label><br>
                                    <input type="checkbox" id="edit_other_admission" name="other_admission" value="1" style="margin-bottom: 0;height: 15px;margin-right: 5px;" onclick="updateOtherAdmission()" {{ $editAdmissionForm->other_admission == 1 ? 'checked' : '' }}/>
                                    <span style="color: red"> {{ $errors->has('other_admission') ? $errors->first('other_admission') : ' ' }}</span>
                                    <label for="other_admission" style="font-weight: 400;">Other Way Admission</label>
                                </div>
                                <div class="col-md-12" id="edit_myAdmission" style="display: none">
                                    <label for="present_address">
                                        Other Way Admission Note
                                    </label><br>
                                    <textarea name="other_admission_note" id="edit_other_admission_note" rows="2" cols="50" class="form-control">{{ $editAdmissionForm->other_admission_note }}</textarea>
                                    <span style="color: red"> {{ $errors->has('s_name') ? $errors->first('s_name') : ' ' }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label for="course">Course Name</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <select name="course" id="course" class="form-control">
                                        <option disabled selected>---Select Course Name---</option>
                                        <option value="web" {{ $editAdmissionForm->course == 'web' ? 'selected' : '' }}>Full Stack Web Development</option>
                                        <option value="digital" {{ $editAdmissionForm->course == 'digital' ? 'selected' : '' }}>Digital Marketing</option>
                                        <option value="english" {{ $editAdmissionForm->course == 'english' ? 'selected' : '' }}>Communication English</option>
                                    </select>
                                    <span style="color: red"> {{ $errors->has('course') ? $errors->first('course') : ' ' }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label for="batch_no">Batch No.</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <select name="batch_no" id="batch_no" class="form-control">
                                        <option disabled selected>---Select Batch Number---</option>
                                        @foreach($batchNumber as $batch)
                                            <option value="{{ $batch->batch_no }}" {{ $batch->batch_no == $editAdmissionForm->batch_no ? 'selected' : '' }}>{{ $batch->batch_no }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color: red"> {{ $errors->has('s_name') ? $errors->first('s_name') : ' ' }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label for="batch_type">Batch Type</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <select name="batch_type" id="batch_type" class="form-control">
                                        <option disabled selected>---Select Batch Type---</option>
                                        <option value="online" {{ $editAdmissionForm->batch_type == 'online' ? 'selected' : '' }}>Online</option>
                                        <option value="offline" {{ $editAdmissionForm->batch_type == 'offline' ? 'selected' : '' }}>Offline</option>
                                    </select>
                                    <span style="color: red"> {{ $errors->has('s_name') ? $errors->first('s_name') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="cash">Payment Type</label><br>
                                    <select name="payment_type" id="payment_type" class="form-control">
                                        <option disabled selected>---Select Payment Type---</option>
                                        <option value="cash" {{ $editAdmissionForm->moneyReceipt->payment_type == 'cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="bkash" {{ $editAdmissionForm->moneyReceipt->payment_type == 'bkash' ? 'selected' : '' }}>Bkash</option>
                                        <option value="nagad" {{ $editAdmissionForm->moneyReceipt->payment_type == 'nagad' ? 'selected' : '' }}>Nagad</option>
                                        <option value="rocket" {{ $editAdmissionForm->moneyReceipt->payment_type == 'rocket' ? 'selected' : '' }}>Rocket</option>
                                        <option value="bank" {{ $editAdmissionForm->moneyReceipt->payment_type == 'bank' ? 'selected' : '' }}>Bank</option>
                                    </select>
                                    <span style="color: red"> {{ $errors->has('s_name') ? $errors->first('s_name') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="admission_date">Admission Date</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="date" name="admission_date" value="{{ $editAdmissionForm->moneyReceipt->admission_date->format('Y-m-d') ?? '' }}" placeholder="Admission Date" class="form-control">
                                    <span style="color: red"> {{ $errors->has('s_name') ? $errors->first('s_name') : ' ' }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label for="total_fee">Total Fee</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="number" name="total_fee" value="{{ $editAdmissionForm->moneyReceipt->total_fee ?? '' }}" id="total_fee" placeholder="Total Taka" class="form-control">
                                    <span style="color: red"> {{ $errors->has('s_name') ? $errors->first('s_name') : ' ' }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label for="advance">Advance</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="number" name="advance" value="{{ $editAdmissionForm->moneyReceipt->advance ?? '' }}" id="advance" placeholder="Advance" onblur="calculate()" class="form-control">
                                    <span style="color: red"> {{ $errors->has('s_name') ? $errors->first('s_name') : ' ' }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label for="due">Due</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="number" name="due" readonly id="due" value="{{ $editAdmissionForm->moneyReceipt->total_fee - $editAdmissionForm->moneyReceipt->advance ?? '0' }}" placeholder="Due" class="form-control">
                                    <span style="color: red"> {{ $errors->has('s_name') ? $errors->first('s_name') : ' ' }}</span>
                                </div>
                                <div class="col-md-12">
                                    <label for="word">In Word</label><br>
                                    <input type="text" name="word" value="{{ $editAdmissionForm->word }}" placeholder="In Word" class="form-control">
                                    <span style="color: red"> {{ $errors->has('s_name') ? $errors->first('s_name') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="time">Class Time</label><span style="color: red; font-size: 16px;"> *</span>
                                    <input type="text" name="class_time" value="{{ $editAdmissionForm->class_time }}" placeholder="Class Time" class="form-control">
                                    <span style="color: red"> {{ $errors->has('s_name') ? $errors->first('s_name') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="shedule">Class Shedule</label><span style="color: red; font-size: 16px;"> *</span>
                                    <div class="d-flex align-items-center Shedule">
                                        <input type="radio" id="first_day" name="class_shedule" value="Sat-Mon-Wed" {{ $editAdmissionForm->class_shedule ===  'Sat-Mon-Wed' ? 'checked' : '' }}>
                                        <label for="first_day" style="font-weight: 400;">Sat Mon Wed</label><br>
                                        <input type="radio" id="last_day" name="class_shedule" value="Sun-Tue-Thu" {{ $editAdmissionForm->class_shedule ===  'Sun-Tue-Thu' ? 'checked' : '' }}>
                                        <label for="last_day" style="font-weight: 400;">Sun Tue Thu</label>
                                        <span style="color: red"> {{ $errors->has('s_name') ? $errors->first('s_name') : ' ' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="avatar" class="mt-2">Avatar</label>
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload"></label>
                                            <span style="color: red"> {{ $errors->has('s_name') ? $errors->first('s_name') : ' ' }}</span>
                                        </div>
                                        <div class="avatar-preview">
                                            <div>
                                                <img src="{{ asset('/student/'.$editAdmissionForm->avatar) }}" style="height: 200px; width: 220px!important;" id="pre-avatar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="addmission-form-submit-btn btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        function calculate(){
            let totalFee = document.getElementById('total_fee').value;
            let advance = document.getElementById('advance').value;
            document.getElementById('due').value = parseInt(totalFee) - parseInt(advance);
        }

        let ifChecked = document.getElementById('edit_other_admission');
        var x = document.getElementById("edit_myAdmission");
        if (ifChecked.checked === true) {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }

        function updateOtherAdmission(){
            let ifChecked = document.getElementById('edit_other_admission');
            console.log(ifChecked);
            var x = document.getElementById("edit_myAdmission");
            //console.log(x);
            if (ifChecked.checked === true) {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

    </script>
@endpush
