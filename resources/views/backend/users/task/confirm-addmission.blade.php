@extends('backend.admin.master')

@section('content')
<div class="wrapper">
    <div class="page-wrapper" style="margin-left: 20px!important;">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Confirm Addmission</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/employee/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <!-- <li class="breadcrumb-item active" aria-current="page">
                                <a href="#">List Task</a>
                            </li>  -->
                            <li class="breadcrumb-item active" aria-current="page">Confirm Addmission</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Confirm Addmission</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <form class="form-group" action="{{ url('/confirm/addmission') }}" method="get">
                        @csrf
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-6 mb-3">
                                <input type="number" name="search" class="form-control" placeholder="Enter only batch no...">
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
                                    <a href="{{ url('/confirm/addmission') }}" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Admission Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Profession</th>
                                <th width="20%">Course Name</th>
                                <th>Batch No.</th>
                                <th>Note</th>
                                <th width="10%">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($complete as $data )
                                    <tr>
                                        <td>{{ date('d-m-Y', strtotime($data->moneyReceipt->admission_date)) ?? 'No date found' }}</td>
                                        <td>{{ $data->s_name ?? '' }}</td>
                                        <td>{{ $data->s_email ?? '' }}</td>
                                        <td>{{ $data->s_phone ?? '' }}</td>
                                        <td>{{ $data->profession ?? '' }}</td>
                                        <td>
                                            @if($data->course == 'web')
                                                Full stack web development
                                            @elseif($data->course == 'digital')
                                                Advanced digital marketing
                                            @else
                                                Communication English
                                            @endif
                                        </td>
                                        <td>{{ $data->batch_no ?? '' }}</td>
                                        <td></td>
                                        <td width="10%">
                                            <span style="background: green; color: #fff; padding: 5px">Admission Done</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $complete->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
