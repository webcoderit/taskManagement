@extends('backend.admin.master')

@section('content')
    <section class="student-addmission-form-section">
        <div class="container">
            <div class="row">
                <div class="col-md-10 m-auto">
                    <div class="addmission-form-wrapper">
                        <div class="addmission-form-heading">
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
                        <form class="form-group addmission-form">
                            <div class="row">
                                <div class="col-md-6">
                                     <label for="student_name">Student Name</label><br>
                                     <input type="text" name="s_name" placeholder="Student Name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                     <label for="email">Email</label><br>
                                     <input type="email" name="s_email" placeholder="Student Email" class="form-control">
                                </div>
                                <div class="col-md-6">
                                     <label for="father_name">Father Name</label><br>
                                     <input type="text" name="f_name" placeholder="Father Name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                     <label for="mother_name">Mother Name</label><br>
                                     <input type="text" name="m_name" placeholder="Mother Name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                     <label for="student_phone">Student Phone No.</label><br>
                                     <input type="number" name="s_phone" placeholder="Student Phone No." class="form-control">
                                </div>
                                <div class="col-md-6">
                                     <label for="father_phone">Father Phone No.</label><br>
                                     <input type="number" name="f_phone" placeholder="Father Phone No." class="form-control">
                                </div>
                                <div class="col-md-6">
                                     <label for="birth_date">Date Of Birth</label><br>
                                     <input type="date" name="dob" placeholder="Date Of Birth" class="form-control">
                                </div>
                                <div class="col-md-6">
                                     <label for="profession">Profession</label><br>
                                     <input type="text" name="profession" placeholder="Student Profession" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="gender">Gender</label>
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
                                     <label for="blood_group">Blood Group</label><br>
                                     <input type="text" name="blood_group" placeholder="Blood Group " class="form-control">
                                </div>
                                <div class="col-md-6">
                                     <label for="qualificaton">Educational Qualification</label><br>
                                     <input type="text" name="qualification" placeholder="Educational Qualifications" class="form-control">
                                </div>
                                <div class="col-md-6">
                                     <label for="nid_birth_no">NID/Birth Certificate No.</label><br>
                                     <input type="text" name="nid" placeholder="NID/Birth Certificate No." class="form-control">
                                </div>
                                <div class="col-md-6">
                                     <label for="present_address">Present Address</label><br>
                                     <textarea name="present_address" rows="4" cols="50" class="form-control"></textarea>
                                </div>
                                <div class="col-md-6">
                                     <label for="permanent_address">Permanent Address</label><br>
                                     <textarea name="permanent_address" rows="4" cols="50" class="form-control"></textarea>
                                </div>
                                <div class="col-md-4">
                                     <label for="course">Course Name</label><br>
                                     <select name="course" id="course" class="form-control">
                                          <option disabled selected>---Select Course Name---</option>
                                          <option value="web">Full Stack Web Development</option>
                                          <option value="digital">Digital Marketing</option>
                                          <option value="english">Communication English</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                     <label for="batch_number">Batch No.</label><br>
                                     <input type="text" name="batch_number" placeholder="Batch No." class="form-control">
                                </div>
                                <div class="col-md-4">
                                     <label for="batch_type">Batch Type</label><br>
                                     <select name="batch_type" id="batch_type" class="form-control">
                                          <option disabled selected>---Select Batch Type---</option>
                                          <option value="online">Online</option>
                                          <option value="offline">Offline</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="shedule">Class Shedule</label>
                                    <div class="d-flex align-items-center Shedule">
                                        <input type="radio" id="first_day" name="class_shedule" value="1">
                                        <label for="first_day">Sat Mon Wed</label><br>
                                        <input type="radio" id="last_day" name="class_shedule" value="2">
                                        <label for="last_day">Sun Tue Thu</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="time">Class Time</label>
                                    <div class="d-flex align-items-center time">
                                        <input type="radio" id="am" name="class_time" value="am">
                                        <label for="am">AM</label><br>
                                        <input type="radio" id="pm" name="class_time" value="pm">
                                        <label for="pm">PM</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" onchange="imagePreview(event)" />
                                            <label for="imageUpload"></label>
                                        </div>
                                        @if(auth()->check())
                                            <div class="avatar-preview mt-4">
                                                <div>
                                                    <img src="{{ asset('/avatar/'.auth()->user()->avatar) }}" style="height: 200px; width: 220px;" id="pre-avatar">
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
