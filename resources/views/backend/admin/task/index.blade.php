@extends('backend.admin.admin-master')

@section('content')
<div class="wrapper">
    <div class="page-wrapper" style="margin-left: 20px!important;">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">List Task</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ url('/admin/user/add/task') }}">Add Task</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">List Task</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ Session::get('error') }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Task List</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/admin/user/list/task') }}" method="get">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <label for="date" style="font-weight: 600; margin-bottom: 5px;">
                                        Date
                                    </label><br>
                                    <input type="date" name="task_date" class="form-control" placeholder="Date" />
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group" style="margin-top: 25px;">
                                        <button type="submit" class="input-group-text btn btn-primary">
                                            Search
                                        </button>
                                        <a href="{{ url('/admin/user/list/task') }}" class="input-group-text btn btn-danger">
                                            Clear
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @if($page == 'task_date')
                    <div class="table-responsive mt-3">
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Employee name</th>
                                <th>Assign Task</th>
                                <th>Complete Task</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $key => $task)
                                <tr>
                                    <td>{{ $loop->index+1}}</td>
                                    <td>{{ $task[0]->user->full_name ?? 'No employee name' }}</td>
                                    <td>{{ $task[0]->whereDate('created_at', request()->task_date)->where('user_id', $task[0]->user->id)->get()->count() }}</td>
                                    <td>{{ $task[0]->whereDate('created_at', request()->task_date)->where('status', 1)->where('user_id', $task[0]->user->id)->get()->count() }}</td>
                                    <td width="10%">
                                        <a href="{{ url('/admin/user/task/view/'.$task[0]->user->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="table-responsive mt-3">
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Employee name</th>
                                <th>Today Task</th>
                                <th>Today Complete Task</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $key => $task)
                                <tr>
                                    <td>{{ $loop->index+1}}</td>
                                    <td>{{ $task[0]->user->full_name ?? 'No employee name' }}</td>
                                    <td>{{ $task[0]->whereDate('created_at', \Carbon\Carbon::today())->where('user_id', $task[0]->user->id)->get()->count() }}</td>
                                    <td>{{ $task[0]->whereDate('created_at', \Carbon\Carbon::today())->where('status', 1)->where('user_id', $task[0]->user->id)->get()->count() }}</td>
                                    <td width="10%">
                                        <a href="{{ url('/admin/user/task/view/'.$task[0]->user->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
