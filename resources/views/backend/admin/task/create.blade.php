@extends('backend.admin.master')

@section('content')
<div class="wrapper">
    <div class="page-wrapper" style="margin-left: 20px!important;">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Task</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="#">Manage Task</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="#">Add Task</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="card border-top border-0 border-4 border-danger">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxs-user me-1 font-22 text-danger"></i>
                        </div>
                        <h5 class="mb-0 text-danger">Add Task</h5>
                    </div>
                    <hr>
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ Session::get('success') }}.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-4">
                            <label for="user_name" class="form-label">Select a User Name</label><br>
                            <select name="user" id="user_name" class="form-control">
                                <option value="saidul">Saidul Islam</option>
                                <option value="noman">Abdullah Noman</option>
                                <option value="shariar">Shariar Ikbal</option>
                                <option value="rifat">Rifat Ahamed</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="last_name" class="form-label">Student Name</label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                                <input type="text" class="form-control border-start-0" name="student_name" id="student_name" placeholder="Student Name" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="display: flex;align-items: end;">
                                <div>
                                    <label for="last_name" class="form-label">Student Phone No.</label>
                                    <div class="input-group"><span class="input-group-text bg-transparent"><i class='bx bxs-phone'></i></span>
                                        <input type="number" class="form-control border-start-0" name="phone" id="student_phone" placeholder="Student Phone" />
                                    </div>
                                </div>
                                <div>
                                    <button type="button" class="add-btn-inner">Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="last_name" class="form-label">Student Facebook ID</label>
                            <div class="input-group"><span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                                <input type="text" class="form-control border-start-0" name="fb_id" id="fb_id" placeholder="Student Facebook ID" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="last_name" class="form-label">Student Address</label>
                            <div class="input-group">
                                <textarea name="address" rows="1" cols="50" class="form-control">
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="last_name" class="form-label">Student Email</label>
                            <div class="input-group"><span class="input-group-text bg-transparent"><i class='bx bxs-message'></i></span>
                                <input type="email" class="form-control border-start-0" name="email" id="email" placeholder="Student Email" />
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-danger px-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
