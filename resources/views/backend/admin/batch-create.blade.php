@extends('backend.admin.admin-master')

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="wrapper">
        <div class="page-wrapper" style="margin-left: 20px!important;">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Batch</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ url('/admin/batch/create') }}">Manage Batch</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Add Batch
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
                            <h5 class="mb-0 text-danger">Add Batch</h5>
                        </div>
                        <hr>
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
                        @if(isset($errors) && $errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <h2>Create Batch</h2>
                        <form class="row g-3" action="{{ url('/admin/batch/store') }}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <label for="user_id" class="form-label">Select A Course<small class="text-danger">*</small></label><br>
                                <select name="course_name" id="course_name" class="form-control">
                                    <option disabled selected>---Select Course Name---</option>
                                    <option value="web">Full Stack Web Development</option>
                                    <option value="attachment_web">Industrial attachment ( Web )</option>
                                    <option value="attachment_adm">Industrial attachment ( ADM )</option>
                                    <option value="digital">Digital Marketing</option>
                                    <option value="english">Communication English</option>
                                </select>
                                <span style="color: red"> {{ $errors->has('course_name') ? $errors->first('course_name') : ' ' }}</span>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Batch No<small class="text-danger">*</small></label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                                    <input type="text" class="form-control border-start-0" name="batch_no" id="batch_no" placeholder="Enter batch name...." />
                                </div>
                                <span style="color: red"> {{ $errors->has('batch_no') ? $errors->first('batch_no') : ' ' }}</span>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success px-5">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>Name</th>
                                    <th>Number</th>
                                    <th width="20%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($batchList as $list)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>
                                                @if($list->course_name == 'web')
                                                    Full Stack Web Development
                                                @elseif($list->course_name == 'digital')
                                                    Advance Digital Marketing
                                                @else
                                                    Communication English
                                                @endif
                                            </td>
                                            <td>{{ $list->batch_no }}</td>
                                            <td>
                                                <a href="{{ url('/admin/batch/delete/'.$list->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
@endpush
