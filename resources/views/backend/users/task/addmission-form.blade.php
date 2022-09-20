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
                    <div class="addmission-form-wrapper">
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
                        <form class="form-group addmission-form" action="{{ url('/admission/store') }}" method="post" enctype="multipart/form-data">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
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
                $('#online_charge').hide();
            }else {
                $('#online_charge').show();
            }
        }

    </script>
@endpush
