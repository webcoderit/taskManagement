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
            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ Session::get('error') }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Employee name</th>
                                <th>Student name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Fb link</th>
                                <th>PC/Laptop</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $key => $task)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $task->user->full_name ?? 'No employee name' }}</td>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->email ?? 'No email found' }}</td>
                                    <td>{{ $task->phone ?? 'No phone found' }}</td>
                                    <td>{{ $task->fb_id ?? 'No Fb link found' }}</td>
                                    <td style="text-transform: capitalize">{{ $task->device ?? 'No Device name found' }}</td>
                                    <td width="10%">
                                        <a href="{{ url('/admin/user/task/edit/'.$task->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <a href="{{ url('/admin/user/task/delete/'.$task->id) }}" onclick="return confirm('Are you sure delete this information')" class="btn btn-sm btn-danger">
                                            <i class="bx bx-trash-alt"></i>
                                        </a>
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
