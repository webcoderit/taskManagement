@extends('backend.admin.master')

@section('content')
    <section class="student-addmission-form-section">
        <div class="container">
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ Session::get('success') }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ Session::get('error') }}.
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
                    <div class="addmission-form-wrapper" style="position: relative;" id="admissionForm">
                        <div id="admission-loading" style="display: none" >
                            <i class="fa fa-spinner fa-pulse fa-5x fa-fw" aria-hidden="true"></i>
                        </div>
                        <div class="addmission-form-heading">
                            <div class="addmission-list-btn-outer">
                                <a href="{{ url('/addmission/list') }}" class="addmission-list-btn-inner">Admission List</a>
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
                        <p class="text-center text-danger" id="s_phone_error"></p>
                        <p class="text-center text-danger" id="s_email_error"></p>
                        <p class="text-center text-danger" id="advance_error"></p>
                        <p class="text-center text-danger" id="due_error"></p>
                        <p class="text-center text-danger" id="total_fee_error"></p>
                        <!-- <form class="form-group addmission-form" action="{{ url('/admission/store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="student_name">Student Name</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="s_name" value="{{ old('s_name') }}" placeholder="Student Name" class="form-control">
                                    <span style="color: red"> {{ $errors->has('s_name') ? $errors->first('s_name') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email</label><br>
                                    <input type="email" name="s_email" value="{{ old('s_email') }}" placeholder="Student Email" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="father_name">Father Name</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="f_name" value="{{ old('f_name') }}" placeholder="Father Name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="mother_name">Mother Name</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="m_name" value="{{ old('m_name') }}" placeholder="Mother Name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="student_phone">Student Phone No.</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="tel" name="s_phone" value="{{ old('s_phone') }}" placeholder="Student Phone No." class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="father_phone">Father Phone No.</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="tel" name="f_phone" value="{{ old('f_phone') }}" placeholder="Father Phone No." class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="birth_date">Date Of Birth</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="date" name="dob" value="{{ old('dob') }}" placeholder="Date Of Birth" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="profession">Profession</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="profession" value="{{ old('profession') }}" placeholder="Student Profession" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="gender">Gender</label><span style="color: red; font-size: 16px;"> *</span>
                                    <div class="d-flex align-items-center gender">
                                        <input type="radio" id="male" name="gender" value="Male">
                                        <label for="male">Male</label><br>
                                        <input type="radio" id="female" name="gender" value="Female">
                                        <label for="female">Female</label><br>
                                        <input type="radio" id="others" name="gender" value="Others">
                                        <label for="others">Others</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="blood_group">Blood Group</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="blood_group" value="{{ old('blood_group') }}" placeholder="Blood Group " class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="qualificaton">Educational Qualification</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="qualification" value="{{ old('qualification') }}" placeholder="Educational Qualifications" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="nid_birth_no">NID/Birth Certificate No.</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="number" name="nid" value="{{ old('nid') }}" placeholder="NID/Birth Certificate No." class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="student_fb_name">Student FB Name/ FB Link</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="fb_id" value="{{ old('fb_id') }}" placeholder="Student FB Name or ID" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="student_ref_name">Student Reference Name</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="reference" value="{{ old('reference') }}" placeholder="Student Reference Name" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="present_address">Address</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <textarea name="present_address" rows="2" cols="50" class="form-control">{{ old('present_address') }}</textarea>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label>Other Admission</label><br>
                                    <input type="checkbox" id="other_admission" name="other_admission" value="1" style="margin-bottom: 0;height: 15px;margin-right: 5px;" onclick="otherAdmission()">
                                    <label for="other_admission" style="font-weight: 400;">Other Way Admission</label>
                                </div>
                                <div class="col-md-12" id="myAdmission" style="display: none">
                                    <label for="present_address">
                                        Other Way Admission Note
                                    </label><br>
                                    <textarea name="other_admission_note" id="other_admission_note" rows="2" cols="50" class="form-control">{{ old('other_admission_note') }}</textarea>
                                </div>
                                <div class="col-md-3">
                                    <label for="course">Course Name</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <select name="course" id="course" class="form-control">
                                        <option disabled selected>---Select Course Name---</option>
                                        <option value="web">Full Stack Web Development</option>
                                        <option value="digital">Digital Marketing</option>
                                        <option value="english">Communication English</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="batch_no">Batch No.</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <select name="batch_no" id="batch_no" class="form-control">
                                        <option disabled selected>---Select Batch Number---</option>
                                        @foreach($batchNumber as $batch)
                                            <option value="{{ $batch->batch_no }}">{{ $batch->batch_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="batch_type">Batch Type</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <select name="batch_type" id="batch_type" class="form-control">
                                        <option disabled selected>---Select Batch Type---</option>
                                        <option value="online">Online</option>
                                        <option value="offline">Offline</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="admission_date">Admission Date</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="admission_date" value="{{ date('Y-m-d') }}" readonly min="{{ date('Y-m-d') }}" placeholder="Admission Date" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="cash">Payment Type</label><br>
                                    <select name="payment_type" id="payment_type" class="form-control" onchange="chargeField(this.value)">
                                        <option disabled selected>---Select Payment Type---</option>
                                        <option value="cash">Cash</option>
                                        <option value="bkash">Bkash</option>
                                        <option value="nagad">Nagad</option>
                                        <option value="rocket">Rocket</option>
                                        <option value="bank">Bank</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="advance">Transaction Cost</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="number" name="online_charge" value="{{old('online_charge')}}" id="online_charge" placeholder="Online Charge" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="advance">Transaction ID</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="transaction_id" value="{{old('transaction_id')}}" id="transaction_id" placeholder="Transaction Id" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="transaction_number">Transaction Number</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="text" name="transaction_number" value="{{old('transaction_number')}}" id="transaction_number" placeholder="Transaction Number" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="total_fee">Total Fee</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="number" name="total_fee" value="{{old('total_fee')}}" id="total_fee" placeholder="Total Taka" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="advance">Advance</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="number" name="advance" value="{{old('advance')}}" id="advance" placeholder="Advance" onblur="calculate()" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="due">Due</label><span style="color: red; font-size: 16px;"> *</span><br>
                                    <input type="number" name="due" readonly value="0" id="due" placeholder="Due" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="word">In Word</label><br>
                                    <input type="text" name="word" value="{{old('word')}}" placeholder="In Word" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="time">Class Time</label><span style="color: red; font-size: 16px;"> *</span>
                                    <input type="text" name="class_time" value="{{old('class_time')}}" placeholder="Class Time" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="shedule">Class Shedule</label><span style="color: red; font-size: 16px;"> *</span>
                                    <div class="d-flex align-items-center Shedule">
                                        <input type="radio" id="first_day" name="class_shedule" value="Sat-Mon-Wed">
                                        <label for="first_day" style="font-weight: 400;">Sat Mon Wed</label><br>
                                        <input type="radio" id="last_day" name="class_shedule" value="Sun-Tue-Thu">
                                        <label for="last_day" style="font-weight: 400;">Sun Tue Thu</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="avatar" class="mt-2">Avatar</label>
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" onchange="imagePreview(event)" />
                                            <label for="imageUpload"></label>
                                        </div>
                                        @if(auth()->check())
                                            <div class="avatar-preview">
                                                <div>
                                                    <img src="{{ asset('backend/') }}/assets/images/download.png" style="height: 200px; width: 220px;" id="pre-avatar">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="addmission-form-submit-btn btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form> -->
                        <form id="msform" method="post" enctype="multipart/form-data">
                            @csrf
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="personal"><strong>Personal</strong></li>
                                <li id="professional"><strong>Professional</strong></li>
                                <li id="address"><strong>Address</strong></li>
                                <li id="payment"><strong>Payment</strong></li>
                                <li id="image"><strong>Image</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> <br> <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Personal Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 1 - 5</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                             <label for="student_name">Student Name</label><span style="color: red; font-size: 16px;"> *</span><br>
                                             <input type="text" name="s_name" id="s_name" value="{{ old('s_name') }}" placeholder="Student Name" class="form-control" required>
                                            <span style="color: red"> {{ $errors->has('s_name') ? $errors->first('s_name') : ' ' }}</span>
                                        </div>
                                        <div class="col-md-6">
                                             <label for="email">Email</label><span style="color: red; font-size: 16px;"> *</span><br>
                                             <input type="email" name="s_email" id="s_email" value="{{ old('s_email') }}" placeholder="Student Email" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                             <label for="father_name">Father Name</label><span style="color: red; font-size: 16px;"> *</span><br>
                                             <input type="text" name="f_name" id="f_name" value="{{ old('f_name') }}" placeholder="Father Name" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                             <label for="mother_name">Mother Name</label><span style="color: red; font-size: 16px;"> *</span><br>
                                             <input type="text" name="m_name" id="m_name" value="{{ old('m_name') }}" placeholder="Mother Name" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                             <label for="student_phone">Student Phone No.</label><span style="color: red; font-size: 16px;"> *</span><br>
                                             <input type="tel" name="s_phone" id="s_phone" value="{{ old('s_phone') }}" placeholder="Student Phone No." class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                             <label for="father_phone">Father Phone No.</label><span style="color: red; font-size: 16px;"> *</span><br>
                                             <input type="tel" name="f_phone" id="f_phone" value="{{ old('f_phone') }}" placeholder="Father Phone No." class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="next" class="next action-button" value="Next" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Professional Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 2 - 5</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                             <label for="birth_date">Date Of Birth</label><span style="color: red; font-size: 16px;"> *</span><br>
                                             <input type="date" name="dob" id="dob" value="{{ old('dob') }}" placeholder="Date Of Birth" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                             <label for="profession">Profession</label><span style="color: red; font-size: 16px;"> *</span><br>
                                             <input type="text" name="profession" id="profession" value="{{ old('profession') }}" placeholder="Student Profession" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="gender">Gender</label><span style="color: red; font-size: 16px;"> *</span>
                                            <div class="d-flex align-items-center gender">
                                                <select class="form-control" name="gender" id="gender">
                                                    <option selected disabled>Select a Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Others">Others</option>
                                                </select>
{{--                                                <input type="radio" id="male" name="gender" value="Male">--}}
{{--                                                <label for="male">Male</label><br>--}}
{{--                                                <input type="radio" id="female" name="gender" value="Female">--}}
{{--                                                <label for="female">Female</label><br>--}}
{{--                                                <input type="radio" id="others" name="gender" value="Others">--}}
{{--                                                <label for="others">Others</label>--}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                             <label for="blood_group">Blood Group</label><span style="color: red; font-size: 16px;"> *</span><br>
                                             <input type="text" name="blood_group" id="blood_group" value="{{ old('blood_group') }}" placeholder="Blood Group " class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                             <label for="qualification">Educational Qualification</label><span style="color: red; font-size: 16px;"> *</span><br>
                                             <input type="text" name="qualification" id="qualification" value="{{ old('qualification') }}" placeholder="Educational Qualifications" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                             <label for="nid_birth_no">NID/Birth Certificate No.</label><span style="color: red; font-size: 16px;"> *</span><br>
                                             <input type="number" name="nid" id="nid" value="{{ old('nid') }}" placeholder="NID/Birth Certificate No." class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                             <label for="student_fb_name">Student FB Name/ FB Link</label><span style="color: red; font-size: 16px;"> *</span><br>
                                             <input type="text" name="fb_id" id="fb_id" value="{{ old('fb_id') }}" placeholder="Student FB Name or ID" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                             <label for="student_ref_name">Student Reference Name</label><span style="color: red; font-size: 16px;"> *</span><br>
                                             <input type="text" name="reference" id="reference" value="{{ old('reference') }}" placeholder="Student Reference Name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="next" class="next action-button" value="Next" />
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Address Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 3 - 5</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                             <label for="present_address">Address</label><span style="color: red; font-size: 16px;"> *</span><br>
                                             <textarea name="present_address" id="present_address" rows="2" cols="50" class="form-control">{{ old('present_address') }}</textarea>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label>Other Admission</label><br>
                                             <input type="checkbox" id="other_admission" name="other_admission" value="1" style="margin-bottom: 0;height: 15px;margin-right: 5px;width: auto;" onclick="otherAdmission()">
                                             <label for="other_admission" style="font-weight: 400;">Other Way Admission</label>
                                        </div>
                                        <div class="col-md-12" id="myAdmission" style="display: none">
                                             <label for="present_address">
                                                 Other Way Admission Note
                                             </label><br>
                                             <textarea name="other_admission_note" id="other_admission_note" rows="2" cols="50" class="form-control">{{ old('other_admission_note') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Payment Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 4 - 5</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3">
                                             <label for="course">Course Name</label><span style="color: red; font-size: 16px;"> *</span><br>
                                            <select name="course" id="course" class="form-control">
                                                <option disabled selected>---Select Course Name---</option>
                                                <option value="web">Full Stack Web Development</option>
                                                <option value="attachment_web">Industrial Attachment ( Web )</option>
                                                <option value="attachment_adm">Industrial Attachment ( ADM )</option>
                                                <option value="digital">Digital Marketing</option>
                                                <option value="english">Communication English</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                             <label for="batch_no">Batch No.</label><span style="color: red; font-size: 16px;"> *</span><br>
                                            <select name="batch_no" id="batch_no" class="form-control">
                                                <option disabled selected>---Select Batch Number---</option>
                                                @foreach($batchNumber as $batch)
                                                    <option value="{{ $batch->batch_no }}">{{ $batch->batch_no }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                             <label for="batch_type">Batch Type</label><span style="color: red; font-size: 16px;"> *</span><br>
                                             <select name="batch_type" id="batch_type" class="form-control">
                                                  <option disabled selected>---Select Batch Type---</option>
                                                  <option value="online">Online</option>
                                                  <option value="offline">Offline</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="admission_date">Admission Date</label><span style="color: red; font-size: 16px;"> *</span><br>
                                            <input type="text" name="admission_date" id="admission_date" value="{{ date('Y-m-d') }}" readonly min="{{ date('Y-m-d') }}" placeholder="Admission Date" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="cash">Payment Type</label><br>
                                            <select name="payment_type" id="payment_type" class="form-control" onchange="chargeField(this.value)">
                                                <option disabled selected>---Select Payment Type---</option>
                                                <option value="cash">Cash</option>
                                                <option value="bkash">Bkash</option>
                                                <option value="nagad">Nagad</option>
                                                <option value="rocket">Rocket</option>
                                                <option value="bank">Bank</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="advance">Bkash / Rocket / Nogod Charge</label><span style="color: red; font-size: 16px;"> *</span><br>
                                            <input type="number" name="online_charge" value="{{old('online_charge')}}" id="online_charge" placeholder="Online Charge" class="form-control online_charge_system">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="advance">Transaction ID</label><br>
                                            <input type="text" name="transaction_id" value="{{old('transaction_id')}}" id="transaction_id" placeholder="Transaction Id" class="form-control online_charge_system">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="total_fee">Total Fee</label><span style="color: red; font-size: 16px;"> *</span><br>
                                            <input type="number" name="total_fee" value="{{old('total_fee')}}" id="total_fee" placeholder="Total Taka" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="advance">Advance</label><span style="color: red; font-size: 16px;"> *</span><br>
                                            <input type="number" name="advance" value="{{old('advance')}}" id="advance" placeholder="Advance" onblur="calculate()" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="due">Due</label><span style="color: red; font-size: 16px;"> *</span><br>
                                            <input type="number" name="due" readonly value="0" id="due" placeholder="Due" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="time">Class Time</label><span style="color: red; font-size: 16px;"> *</span>
                                            <input type="text" name="class_time" id="class_time" value="{{old('class_time')}}" placeholder="Class Time" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="shedule">Class Shedule</label><span style="color: red; font-size: 16px;"> *</span>
                                            <div class="d-flex align-items-center Shedule">
                                                <select name="class_schedule" id="class_schedule" class="form-control">
                                                    <option disabled selected>---Select Class Schedule---</option>
                                                    <option value="Sat-Mon-Wed">Sat-Mon-Wed</option>
                                                    <option value="Sun-Tue-Thu">Sun-Tue-Thu</option>
                                                </select>
{{--                                                <input type="radio" id="first_day" name="class_shedule" value="Sat-Mon-Wed">--}}
{{--                                                <label for="first_day" style="font-weight: 400;">Sat Mon Wed</label><br>--}}
{{--                                                <input type="radio" id="last_day" name="class_shedule" value="Sun-Tue-Thu">--}}
{{--                                                <label for="last_day" style="font-weight: 400;">Sun Tue Thu</label>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                            </fieldset>
                             <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Image Upload:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 5 - 5</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <!-- <label for="avatar" class="mt-2">Avatar</label> -->
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" onchange="imagePreview(event)" />
                                                    <label for="imageUpload"></label>
                                                </div>
                                                @if(auth()->check())
                                                    <div class="avatar-preview">
                                                        <div>
                                                            <img src="{{ asset('backend/') }}/assets/images/download.png" style="height: 200px; width: 220px;" id="pre-avatar">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" id="saveAdmission" name="next" class="next action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        //Admission form start
        let error = 0;
        function validate() {
            if (document.getElementById('s_name').value == "") {
                document.getElementById("s_name_error").innerHTML = 'Please Input Student name';
                error++
            }
            if (document.getElementById('s_email').value == "") {
                document.getElementById("s_email_error").innerHTML = 'Please Input Student email';
                error++
            }

            if (document.getElementById('s_phone').value == "") {
                document.getElementById("s_phone_error").innerHTML = 'Please Input Student Phone number';
                error++
            }

            if (document.getElementById('f_name').value == "") {
                document.getElementById("f_name_error").innerHTML = 'Please Input Student Father name';
                error++
            }

            if (document.getElementById('m_name').value == "") {
                document.getElementById("m_name_error").innerHTML = 'Please Input Student Mother name';
                error++
            }

            if (document.getElementById('f_phone').value == "") {
                document.getElementById("f_phone_error").innerHTML = 'Please Input Student Father phone';
                error++
            }

            if (document.getElementById('dob').value == "") {
                document.getElementById("dob_error").innerHTML = 'Please Input Student Date of Birth';
                error++
            }

            if (document.getElementById('profession').value == "") {
                document.getElementById("profession_error").innerHTML = 'Please Input Student Date of Birth';
                error++
            }

            if (document.getElementById('gender').value == "") {
                document.getElementById("gender_error").innerHTML = 'Please Input Student Date of Birth';
                error++
            }

            if (document.getElementById('blood_group').value == "") {
                document.getElementById("blood_group_error").innerHTML = 'Please Input Student Blood Group';
                error++
            }

            if (document.getElementById('qualification').value == "") {
                document.getElementById("qualification_error").innerHTML = 'Please Input Student Qualification';
                error++
            }

            if (document.getElementById('nid').value == "") {
                document.getElementById("nid_error").innerHTML = 'Please Input Student NID';
                error++
            }

            if (document.getElementById('fb_id').value == "") {
                document.getElementById("fb_id_error").innerHTML = 'Please Input Student FB ID';
                error++
            }

            if (document.getElementById('reference').value == "") {
                document.getElementById("reference_error").innerHTML = 'Please Input Student Reference';
                error++
            }

            if (document.getElementById('present_address').value == "") {
                document.getElementById("present_address_error").innerHTML = 'Please Input Student present address';
                error++
            }

            if (document.getElementById('course').value == "") {
                document.getElementById("course_error").innerHTML = 'Please Input Course';
                error++
            }

            if (document.getElementById('batch_no').value == "") {
                document.getElementById("batch_no_error").innerHTML = 'Please Input batch no';
                error++
            }

            if (document.getElementById('batch_type').value == "") {
                document.getElementById("batch_type_error").innerHTML = 'Please Input batch type';
                error++
            }

            if (document.getElementById('admission_date').value == "") {
                document.getElementById("admission_date_error").innerHTML = 'Please Input admission date';
                error++
            }

            if (document.getElementById('payment_type').value == "") {
                document.getElementById("payment_type_error").innerHTML = 'Please Input payment type';
                error++
            }

            if (document.getElementById('online_charge').value == "") {
                document.getElementById("online_charge_error").innerHTML = 'Please Input online charge';
                error++
            }

            if (document.getElementById('transaction_id').value == "") {
                document.getElementById("transaction_id_error").innerHTML = 'Please Input transaction ID';
                error++
            }

            if (document.getElementById('total_fee').value == "") {
                document.getElementById("total_fee_error").innerHTML = 'Please Input Total Fee';
                error++
            }

            if (document.getElementById('advance').value == "") {
                document.getElementById("advance_error").innerHTML = 'Please Input advance';
                error++
            }

            if (document.getElementById('due').value == "") {
                document.getElementById("due_error").innerHTML = 'Please Input Due';
                error++
            }

            if (document.getElementById('class_time').value == "") {
                document.getElementById("class_time_error").innerHTML = 'Please Input class time';
                error++
            }

            if (document.getElementById('class_schedule').value == "") {
                document.getElementById("class_schedule_error").innerHTML = 'Please Input class schedule';
                error++
            }

            if (document.getElementById('imageUpload').value == "") {
                document.getElementById("imageUpload_error").innerHTML = 'Please Input Student image';
                error++
            }
        }
        function reset_error() {
            error = 0
            document.getElementById("s_name_error").innerHTML = "";
            document.getElementById("s_email_error").innerHTML = "";
            document.getElementById("s_phone_error").innerHTML = "";
            document.getElementById("f_name_error").innerHTML = "";
            document.getElementById("m_name_error").innerHTML = "";
            document.getElementById("f_phone_error").innerHTML = "";
            document.getElementById("dob_error").innerHTML = "";
            document.getElementById("profession_error").innerHTML = "";
            document.getElementById("gender_error").innerHTML = "";
            document.getElementById("blood_group_error").innerHTML = "";
            document.getElementById("qualification_error").innerHTML = "";
            document.getElementById("nid_error").innerHTML = "";
            document.getElementById("fb_id_error").innerHTML = "";
            document.getElementById("reference_error").innerHTML = "";
            document.getElementById("present_address_error").innerHTML = "";
            document.getElementById("course_error").innerHTML = "";
            document.getElementById("batch_no_error").innerHTML = "";
            document.getElementById("batch_type_error").innerHTML = "";
            document.getElementById("admission_date_error").innerHTML = "";
            document.getElementById("payment_type_error").innerHTML = "";
            document.getElementById("online_charge_error").innerHTML = "";
            document.getElementById("transaction_id_error").innerHTML = "";
            document.getElementById("total_fee_error").innerHTML = "";
            document.getElementById("advance_error").innerHTML = "";
            document.getElementById("due_error").innerHTML = "";
            document.getElementById("class_time_error").innerHTML = "";
            document.getElementById("class_schedule_error").innerHTML = "";
            document.getElementById("imageUpload_error").innerHTML = "";
        }

        /*Save currency*/
        document.getElementById('saveAdmission').addEventListener('click', function(){
            let data = new FormData()
            if (document.getElementById('imageUpload').files.length > 0 ) {
                let avatar = document.getElementById('imageUpload').files[0];
                data.append('avatar', avatar, avatar.name);
            }
            data.append('s_name', document.getElementById('s_name').value)
            data.append('s_email', document.getElementById('s_email').value)
            data.append('s_phone', document.getElementById('s_phone').value)
            data.append('f_name', document.getElementById('f_name').value)
            data.append('m_name', document.getElementById('m_name').value)
            data.append('f_phone', document.getElementById('f_phone').value)
            data.append('dob', document.getElementById('dob').value)
            data.append('profession', document.getElementById('profession').value)
            data.append('gender', document.getElementById('gender').value)
            data.append('blood_group', document.getElementById('blood_group').value)
            data.append('qualification', document.getElementById('qualification').value)
            data.append('nid', document.getElementById('nid').value)
            data.append('fb_id', document.getElementById('fb_id').value)
            data.append('present_address', document.getElementById('present_address').value)
            data.append('reference', document.getElementById('reference').value)
            data.append('course', document.getElementById('course').value)
            data.append('batch_no', document.getElementById('batch_no').value)
            data.append('batch_type', document.getElementById('batch_type').value)
            data.append('admission_date', document.getElementById('admission_date').value)
            data.append('payment_type', document.getElementById('payment_type').value)
            data.append('online_charge', document.getElementById('online_charge').value)
            data.append('transaction_id', document.getElementById('transaction_id').value)
            data.append('total_fee', document.getElementById('total_fee').value)
            data.append('advance', document.getElementById('advance').value)
            data.append('due', document.getElementById('due').value)
            data.append('class_time', document.getElementById('class_time').value)
            data.append('class_schedule', document.getElementById('class_schedule').value)
            let settings = { headers: { 'content-type': 'multipart/form-data' } }
            //console.log(data)
            // initialize loading effect
            var height = parseInt(document.getElementById('admissionForm').offsetHeight)
            var padding = (height - 40) / 2
            var loadingStyle = `height: ${height}px; text-align: center; padding: ${padding}px 80px;background: rgba(35, 35, 35, 0.26) none repeat scroll 0% 0%; position: absolute; z-index: 2;width: 100%;top: 0;left:0`
            document.getElementById('admission-loading').setAttribute('style', loadingStyle)
            axios.post('/admission/store', data, settings)
                .then(response => {
                    if(response.status == 200){
                        document.getElementById('admission-loading').setAttribute('style', 'display: none')
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Admission has been successfully added.',
                            showConfirmButton: false,
                            footer: '<a href="{{ url('/addmission/list') }}" style="color: white; text-decoration: none; background-color: red; padding: 10px; width: 100px; border-radius: 5px; text-align: center">Cancel</a>',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        })
                    }
                })
                .catch((error) => {
                    //console.log(error);
                    document.getElementById('admission-loading').setAttribute('style', 'display: none')

                    if(error.response.data.errors.s_phone && error.response.data.errors.s_phone[0]){
                        document.getElementById('s_phone_error').innerHTML = error.response.data.errors.s_phone[0]
                    }
                    if(error.response.data.errors.s_email && error.response.data.errors.s_email[0]){
                        document.getElementById('s_email_error').innerHTML = error.response.data.errors.s_email[0]
                    }
                    if(error.response.data.errors.advance && error.response.data.errors.advance[0]){
                        document.getElementById('advance_error').innerHTML = error.response.data.errors.advance[0]
                    }
                    if(error.response.data.errors.due && error.response.data.errors.due[0]){
                        document.getElementById('due_error').innerHTML = error.response.data.errors.due[0]
                    }
                    if(error.response.data.errors.total_fee && error.response.data.errors.total_fee[0]){
                        document.getElementById('total_fee_error').innerHTML = error.response.data.errors.total_fee[0]
                    }

                    {{--if(error.response.status === 422){--}}
                    {{--    Swal.fire({--}}
                    {{--        icon: 'error',--}}
                    {{--        title: 'Oops ! Try again',--}}
                    {{--        text: 'Something went wrong! Please try again.',--}}
                    {{--        showConfirmButton: false,--}}
                    {{--        footer: '<a href="{{ url('/addmission/form') }}" style="color: white; text-decoration: none; background-color: red; padding: 10px; width: 100px; border-radius: 5px; text-align: center">Cancel</a>',--}}
                    {{--        allowOutsideClick: false,--}}
                    {{--        allowEscapeKey: false,--}}
                    {{--    })--}}
                    {{--}--}}
                });
        })

        //Admission form end
        function calculate(){
            let totalFee = document.getElementById('total_fee').value;
            let advance = document.getElementById('advance').value;
            document.getElementById('due').value = parseInt(totalFee) - parseInt(advance);
        }

        function otherAdmission(){
            var x = document.getElementById("myAdmission");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function chargeField(e){
            if(e == 'cash'){
                $('.online_charge').hide();
            }else {
                $('.online_charge').show();
            }
        }

        $(document).ready(function(){
        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);

        $(".next").click(function(){

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
        step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
        'display': 'none',
        'position': 'relative'
        });
        next_fs.css({'opacity': opacity});
        },
        duration: 500
        });
        setProgressBar(++current);
        });

        $(".previous").click(function(){

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
        step: function(now) {
        // for making fileset appear animation
        opacity = 1 - now;

        current_fs.css({
        'display': 'none',
        'position': 'relative'
        });
        previous_fs.css({'opacity': opacity});
        },
        duration: 500
        });
        setProgressBar(--current);
        });

        function setProgressBar(curStep){
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
        .css("width",percent+"%")
        }

        $(".submit").click(function(){
        return false;
        })

        });

    </script>
@endpush
