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
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Admission Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Profession</th>
                                <th width="20%">Course Name</th>
                                <th>Batch No.</th>
                                <th width="10%">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($complete as $data )
                                    <tr>
                                        <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
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
                                        <td width="10%">
                                            <span style="background: green; color: #fff; padding: 5px">Admission Done</span>
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
