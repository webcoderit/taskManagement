@extends('backend.admin.admin-master')

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
                                    <a href="{{ url('/admin/user/list/task') }}">Manage Task</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Add Task
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
                            <h5 class="mb-0 text-danger">Update Task</h5>
                        </div>
                        <hr>
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ Session::get('success') }}.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if(isset($errors) && $errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <h2 class="mt-5">Single task update</h2>
                        <hr/>
                            <form class="row g-3 mt-1" action="{{ url('/admin/user/task/update/'.$task->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <label for="user_id" class="form-label">Select a User Name<small class="text-danger">*</small></label><br>
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option selected disabled>Select a User Name</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>{{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color: red"> {{ $errors->has('user_id') ? $errors->first('user_id') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Student Name<small class="text-danger">*</small></label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                                        <input type="text" class="form-control border-start-0" value="{{ $task->name ?? old('name')}} }}" name="name" id="name" placeholder="Student Name" />
                                    </div>
                                    <span style="color: red"> {{ $errors->has('name') ? $errors->first('name') : ' ' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <div style="display: flex;align-items: end;">
                                        <div style="width: 100%">
                                            <label for="phone" class="form-label">Student Phone No.<small class="text-danger">*</small></label>
                                            <div class="input-group"><span class="input-group-text bg-transparent"><i class='bx bxs-phone'></i></span>
                                                <input type="tel" class="form-control border-start-0" name="phone" value="{{ $task->phone ?? old('phone') }}" id="phone" placeholder="Student Phone" />
                                            </div>
                                            <span style="color: red"> {{ $errors->has('phone') ? $errors->first('phone') : ' ' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="fb_id" class="form-label">Student Facebook ID<small class="text-danger">( Optional )</small></label>
                                    <div class="input-group"><span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                                        <input type="url" class="form-control border-start-0" value="{{ $task->fb_id ?? old('fb_id') }}" name="fb_id" id="fb_id" placeholder="Student Facebook ID" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Student Address<small class="text-danger">( Optional )</small></label>
                                    <div class="input-group">
                                        <textarea name="address" rows="1" cols="50" class="form-control" placeholder="Enter student address">{{ $task->address ?? old('address') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Student Email<small class="text-danger">( Optional )</small></label>
                                    <div class="input-group"><span class="input-group-text bg-transparent"><i class='bx bxs-message'></i></span>
                                        <input type="email" class="form-control border-start-0" value="{{ $task->email ?? old('email') }}" name="email" id="email" placeholder="Student Email" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="device" class="form-label">PC/Laptop <small class="text-danger">( Optional )</small></label><br>
                                    <select name="device" id="device" class="form-control">
                                        <option selected disabled>Select a type</option>
                                        <option value="yes" {{ $task->device == 'yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="no" {{ $task->device == 'no' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="profession" class="form-label">Profession <small class="text-danger">( Optional )</small></label><br>
                                    <select name="profession" id="profession" class="form-control">
                                        <option selected disabled>Select a type</option>
                                        <option value="job" {{ $task->profession == 'job' ? 'selected' : '' }}>Job</option>
                                        <option value="student" {{ $task->profession == 'student' ? 'selected' : '' }}>Student</option>
                                        <option value="others" {{ $task->profession == 'others' ? 'selected' : '' }}>Others</option>
                                    </select>
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

@push('scripts')

@endpush
