@extends('backend.admin.admin-master')

@section('content')
    <div class="wrapper">
        <div class="page-wrapper" style="margin-left: 20px!important;">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Registration</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="#">Add user</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('admin.user.list') }}">Manage user</a>
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
                            <h5 class="mb-0 text-danger">User Registration</h5>
                        </div>
                        <hr>
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ Session::get('success') }}.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form class="row g-3" action="{{ url('/admin/user/store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                                    <input type="text" class="form-control border-start-0" name="first_name" id="first_name" placeholder="First Name" />
                                </div>
                                <span style="color: red"> {{ $errors->has('first_name') ? $errors->first('first_name') : ' ' }}</span>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                                    <input type="text" class="form-control border-start-0" name="last_name" id="last_name" placeholder="Last Name" />
                                </div>
                                <span style="color: red"> {{ $errors->has('last_name') ? $errors->first('last_name') : ' ' }}</span>
                            </div>
                            <div class="col-12">
                                <label for="phone" class="form-label">Phone No</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-microphone' ></i></span>
                                    <input type="tel" class="form-control border-start-0" name="phone" id="phone" placeholder="Phone No" />
                                </div>
                                <span style="color: red"> {{ $errors->has('phone') ? $errors->first('phone') : ' ' }}</span>
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                                    <input type="email" class="form-control border-start-0" name="email" id="email" placeholder="Email Address" />
                                </div>
                                <span style="color: red"> {{ $errors->has('email') ? $errors->first('email') : ' ' }}</span>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Choose Password</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-lock-open' ></i></span>
                                    <input type="password" class="form-control border-start-0" name="password" id="password" placeholder="Choose Password" />
                                </div>
                                <span style="color: red"> {{ $errors->has('password') ? $errors->first('password') : ' ' }}</span>
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-lock' ></i></span>
                                    <input type="password" class="form-control border-start-0" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" />
                                </div>
                                <span style="color: red"> {{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : ' ' }}</span>
                            </div>
                            <div class="col-12">
                                <label for="avatar" class="form-label">Avatar</label>
                                <input type="file" name="avatar" id="avatar" class="form-control" onchange="imagePreview(event)" />
                                <img src="" id="pre-avatar" />
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-danger px-5">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
