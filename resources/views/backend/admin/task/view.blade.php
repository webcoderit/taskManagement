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
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('admin/user/list/task') }}">List Task</a></li>
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
                    <form action="{{ url('/admin/user/task/view/'.$id) }}" method="get" class="form-group">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>From date</label>
                                    <div class="input-group mb-2">
                                        <input type="date" name="from_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>To date</label>
                                    <div class="input-group mb-2">
                                        <input type="date" name="to_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2" style="margin-top: 20px;">Search</button>
                                    <a href="{{ url('/admin/user/task/view/'.$id) }}" class="input-group-text btn btn-danger" id="basic-addon2" style="margin-top: 20px;">Clear</a>

                                    @if(isset($tasks) > 0)
                                        <a href="#" class="input-group-text btn btn-warning" id="basic-addon2" style="margin-top: 20px;">{{ count($tasks) }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Student name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Fb link</th>
                                <th>PC/Laptop</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $key => $task)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->email ?? 'No email found' }}</td>
                                    <td>{{ $task->phone ?? 'No phone found' }}</td>
                                    <td>{{ $task->fb_id ?? 'No Fb link found' }}</td>
                                    <td style="text-transform: capitalize">{{ $task->device ?? 'No Device name found' }}</td>
                                    <td style="text-transform: capitalize">{{ $task->status == 0 ? 'Pending' : 'Done' }}</td>
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

@push('script')
    <script>
        $(document).ready(function () {
            $('#myDataTable').DataTable({
                lengthMenu: [
                    [20, 25, 50, -1],
                    [20, 25, 50, 'All'],
                ],
            });
        });
    </script>
@endpush
