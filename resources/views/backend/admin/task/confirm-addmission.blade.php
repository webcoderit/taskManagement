@extends('backend.admin.admin-master')

@section('content')
<div class="wrapper">
    <div class="page-wrapper" style="margin-left: 20px!important;">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Complete Addmission</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">
                                <a href="#">List Task</a>
                            </li> --}}
                            <li class="breadcrumb-item active" aria-current="page">Complete Addmission</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Complete Addmission</h6>
            <hr/>
            <div class="search-wrapper">
                <form action="{{ url('/admin/user/complete/admission') }}" method="get" class="form-group search-form-o-outer">
                    @csrf
                    <div class="select-outer">
                        <select name="user_id" id="user_id">
                            <option disabled selected>--- Select a user---</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Search</button>
                    <a href="{{ url('/admin/user/complete/admission') }}" type="button" class="btn btn-danger">Clear</a>
                </form>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Employee Name</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Profession</th>
                                <th width="20%">Course Name</th>
                                <th>Batch No.</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($complete as $data)
                                    <tr>
                                        <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                        <td>{{ $data->task->user->full_name ?? '' }}</td>
                                        <td>{{ $data->task->name ?? '' }}</td>
                                        <td>{{ $data->task->email ?? '' }}</td>
                                        <td>{{ $data->task->phone ?? '' }}</td>
                                        <td>{{ $data->task->profession ?? '' }}</td>
                                        <td>{{ $data->select_course ?? '' }}</td>
                                        <td>{{ $data->batch_number ?? '' }}</td>
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
