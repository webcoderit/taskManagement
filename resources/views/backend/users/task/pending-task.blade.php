@extends('backend.admin.master')

@section('content')
<div class="wrapper">
    <div class="page-wrapper" style="margin-left: 20px!important;">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Pending Task</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/employee/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <!-- <li class="breadcrumb-item active" aria-current="page">
                                <a href="#">List Task</a>
                            </li>  -->
                            <li class="breadcrumb-item active" aria-current="page">Pending Task</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Pending Task</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <form class="form-group" action="{{ url('/pending/task') }}" method="get">
                        @csrf
                        <div class="col-md-12" style="padding-left: 10%;">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <input type="search" name="search" class="form-control" placeholder="Enter Phone Number & Full Name">
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
                                        <a href="{{ url('/pending/task') }}" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>
                                    </div>
                                </div>
                                <div class="col-md-2" style="text-align-last: end;"></div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Profession</th>
                                <th width="10%">Status</th>
                                <th width="10%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pendingTask as $data )
                                <tr>
                                    <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                    <td>{{ $data->name ?? '' }}</td>
                                    <td>{{ $data->email ?? '' }}</td>
                                    <td>{{ $data->phone ?? '' }}</td>
                                    <td>{{ $data->profession ?? '' }}</td>
                                    <td width="10%">
                                        <span style="background: red; color: #fff; padding: 5px">Padding</span>
                                    </td>
                                    <td width="15%">
                                        @if($data->status == 0)
                                            <a href="{{ url('/view/details/'.$data->id) }}" class="btn btn-sm btn-primary">
                                                <i class="bx bx-edit-alt"></i>
                                                View
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-sm btn-success" disabled>
                                                <i class="bx bx-check-circle"></i>
                                                Call Done
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $pendingTask->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
