@extends('backend.admin.admin-master')

@section('content')
    <div class="wrapper">
        <div class="page-wrapper" style="margin-left: 20px!important;">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Employee Log</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Attendance log</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <h6 class="mb-0 text-uppercase">Attendance log</h6>
                <hr/>
                <div class="report-generate-btn">
                    <button type="button" class="btn btn-primary">Report</button>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Employee Name</th>
                                    <th>In time</th>
                                    <th>Out time</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attendances as $attendance)
                                    <tr>
                                        <td>{{ date('d-m-y', strtotime($attendance->created_at)) }}</td>
                                        <td>{{ $attendance->user->full_name ?? '' }}</td>
                                        <td>{{ $attendance->in_time != null ? $attendance->created_at->format('g:i a') : '0:0' }}</td>
                                        <td>{{ $attendance->out_time != null ? $attendance->updated_at->format('g:i a') : '0:0' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
