@extends('backend.admin.master')

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
                                <li class="breadcrumb-item"><a href="{{ url('/employee/dashboard') }}"><i class="bx bx-home-alt"></i></a>
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
                <div class="card">
                    <div class="card-body">
                        <form class="form-group" action="{{ url('/all/task') }}" method="get">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-6 mb-3">
                                    <input type="search" name="search" class="form-control" placeholder="Enter Phone Number & Full Name">
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
                                        <a href="{{ url('/all/task') }}" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive mt-3">
                            <table id="" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Profession</th>
                                    <th>interested Level</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allTask as $task)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $task->name ?? ' ' }}</td>
                                        <td>{{ $task->email ?? ' ' }}</td>
                                        <td>{{ $task->phone ?? ' ' }}</td>
                                        <td>{{ $task->interestes ? ucfirst($task->interestes->profession) : ' ' }}</td>
                                        <td>
                                            {{ $task->interestes ? ucfirst($task->interestes->interest_level) : ' ' }}
                                        </td>
                                        <td>
                                            @if($task->status == 1)
                                                <span class="btn btn-sm btn-success">Call Done</span>
                                            @else
                                                <span class="btn btn-sm btn-danger">Pending</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $allTask->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
