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
                                <li class="breadcrumb-item active" aria-current="page">All Task List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <h6 class="mb-0 text-uppercase">All Task List</h6>
                <hr/>
                @if(Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ Session::get('error') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <form class="form-group" action="{{ url('/admin/user/all/task/list') }}" method="get">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-6 mb-3">
                                    <input type="search" name="search" class="form-control" placeholder="Enter Only Phone Number">
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
                                        <a href="{{ url('/admin/user/all/task/list') }}" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table id="" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Assign Date</th>
                                    <th>Employee name</th>
                                    <th>Student Name</th>
                                    <th>Student Email</th>
                                    <th>Student Phone</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($taskList as $key => $task)
                                    <tr>
                                        <td>{{ $loop->index+1}}</td>
                                        <td>{{ date('M-d-Y', strtotime($task->created_at)) }}</td>
                                        <td>{{ $task->user->full_name ?? 'No employee name' }}</td>
                                        <td>{{ $task->name }}</td>
                                        <td>
                                            {{ $task->email }}
                                        </td>
                                        <td>
                                            {{ $task->phone }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $taskList->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
