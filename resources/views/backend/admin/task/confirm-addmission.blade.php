@extends('backend.admin.admin-master')

@section('content')
<div class="wrapper">
    <div class="page-wrapper" style="margin-left: 20px!important;">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Complete Admission</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">
                                <a href="#">List Task</a>
                            </li> --}}
                            <li class="breadcrumb-item active" aria-current="page">Complete Admission</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Complete Admission</h6>
            <hr/>
            <div class="search-wrapper">

            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form class="form-group" action="{{ url('/admin/user/complete/admission') }}" method="get">
                            @csrf
                            <div class="col-md-12" style="padding-left: 10%;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label style="font-weight: 600;margin-bottom: 5px;">
                                            Select Month
                                        </label><br>
                                        <input type="month" name="month" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label style="font-weight: 600;margin-bottom: 5px;">
                                            Select Employee Name
                                        </label><br>
                                        <select name="user_id" id="user_id" class="form-control">
                                            <option selected disabled>--- Select Employee ---</option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="input-group" style="margin-top: 25px;">
                                            <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
                                            <a href="{{ url('/admin/user/complete/admission') }}" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="text-align-last: end;">
                                       <a href="{{ url('/employee/call-report/download') }}" class="download-btn">
                                            <i class="fa fa-cloud-download"></i>
                                            Download PDF
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Employee Name</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th width="20%">Course Name</th>
                                <th>Batch No.</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($complete as $data)
                                    <tr>
                                        <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                        <td>{{ $data->user->full_name ?? '' }}</td>
                                        <td>{{ $data->s_name ?? '' }}</td>
                                        <td>{{ $data->s_phone ?? '' }}</td>
                                        <td style="text-transform: capitalize">
                                            @if($data->course == 'web')
                                                Full stack web development
                                            @elseif($data->course == 'digital')
                                                Advanced digital marketing
                                            @else
                                                Communication English
                                            @endif
                                        </td>
                                        <td>{{ $data->batch_no ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tr>
                                <td style="font-weight: 700">Total Admission : {{ count($complete) }}</td>
                            </tr>
                        </table>
                        {{ $complete->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        $("#example").dataTables({
            "bPaginate":true,
            "sPaginationType":"full_numbers",
            "iDisplayLength": 15
        });
    </script>
@endpush
