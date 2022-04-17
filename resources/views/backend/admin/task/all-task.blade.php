@extends('backend.admin.admin-master')

@section('content')
<div class="wrapper">
    <div class="page-wrapper" style="margin-left: 20px!important;">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">All Task</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">
                                <a href="#">List Task</a>
                            </li> --}}
                            <li class="breadcrumb-item active" aria-current="page">All Task</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">All Task</h6>
            <hr/>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ Session::get('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Facebook ID</th>
                                <th>Employment Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <span class="custom-green-badge">Employed</span>
                                        <span class="custom-red-badge">Terminated</span>

                                    </td>
                                    <td width="15%">
                                        <a href="#" class="btn btn-sm btn-primary">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success">
                                            <i class="bx bx-like"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning">
                                            <i class="bx bx-dislike"></i>
                                        </a>
                                        <a href="#" onclick="return confirm('Are you sure delete this information')" class="btn btn-sm btn-danger">
                                            <i class="bx bx-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
