@extends('backend.admin.admin-master')

@section('content')
	<div class="wrapper">
	    <div class="page-wrapper" style="margin-left: 20px!important;">
	        <div class="page-content">
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ Session::get('success') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
	            <!--breadcrumb-->
	            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	                <div class="breadcrumb-title pe-3">Student Due List</div>
	                <div class="ps-3">
	                    <nav aria-label="breadcrumb">
	                        <ol class="breadcrumb mb-0 p-0">
	                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
	                            </li>
	                            <li class="breadcrumb-item active" aria-current="page">Student Due List</li>
	                        </ol>
	                    </nav>
	                </div>
	            </div>
	            <!--end breadcrumb-->
                <div class="col-md-12">
                    <form action="{{ url('/admin/user/due/report') }}" method="get" class="form-group">
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
                                    <a href="{{ url('/admin/user/due/report') }}" class="input-group-text btn btn-danger" id="basic-addon2" style="margin-top: 20px;">Clear</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
	            <hr/>
	            <div class="card">
	                <div class="card-body">
                        <form class="form-group" action="{{ url('/admin/user/due/report') }}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="batch" style="font-weight: 600; margin-bottom: 5px;">
                                        Batch No:
                                    </label><br>
                                    <select name="batch_no" id="batchNo" class="form-control">
                                        <option selected disabled>--- Select Batch No ---</option>
                                        @foreach($batchs as $batchNo)
                                            <option value="{{ $batchNo->batch_no }}">{{ ucfirst($batchNo->course_name) }} - {{ $batchNo->batch_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group" style="margin-top: 25px;">
                                        <button type="submit" class="input-group-text btn btn-primary">
                                            Search
                                        </button>
                                        <a href="{{ url('/admin/user/due/report') }}" class="input-group-text btn btn-danger">
                                            Clear
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    @if(isset($admissionStudents) > 0)
                                    <label for="batch" style="font-weight: 600; margin-bottom: 10px;">
                                        Total Student:
                                    </label><br>
                                        <span class="total-student-count">
                                            {{ count($admissionStudents) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </form>
	                    <div class="table-responsive mt-3">
{{--                            <a href="{{ url('/admin/user/admission/filtering/report/download/'.request()->from_date . '/' . request()->to_date) }}" class="input-group-text btn btn-info float-end" id="basic-addon2" style="">Due Report Download</a>--}}
	                        <table id="" class="table table-striped table-bordered">
	                            <thead>
	                            <tr>
	                                <th>Due Collect Date</th>
	                                <th>Marketing Officer Name</th>
	                                <th>Name</th>
	                                <th>Phone</th>
                                    <th width="15%">Student FB ID</th>
	                                <th>Course Name</th>
	                                <th>Batch No</th>
	                                <th>Course Fee</th>
	                                <th>First Payment</th>
	                                <th>Second Payment</th>
	                                <th>Due</th>
	                                <th>Due Opinion</th>
	                                {{-- <th width="15%">Admission Opinion</th> --}}
	                                {{-- <th>Action</th> --}}
	                            </tr>
	                            </thead>
	                            <tbody>
                                @foreach($admissionStudents as $admissionStudent)
                                    <tr>
                                        <td>
                                            @if($admissionStudent->moneyReceipt->is_pay == 1)
                                                {{ $admissionStudent->moneyReceipt->updated_at->format('Y-m-d') }} <br/>
                                                <a href="{{ url('/paid/money/receipt/download/'.$admissionStudent->id) }}" class="btn btn-sm btn-facebook" title="Download Money Receipt">
                                                    <i class="bx bx-download"></i>
                                                </a>
                                            @else
                                                <span>Not paid yet</span>
                                            @endif
                                        </td>
                                        <td>{{ $admissionStudent->user->full_name?? session()->get('name') }}</td>
                                        <td>{{ $admissionStudent->s_name?? '' }}</td>
                                        <td>{{ $admissionStudent->s_phone ?? '' }}</td>
                                        <td width="15%">
                                            <a href="{{ $admissionStudent->fb_id ?? '' }}" target="_blank">{{ Str::substr($admissionStudent->fb_id, 0, 50) ?? '' }}</a>
                                        </td>
                                        <td>
                                            @if($admissionStudent->course == 'web')
                                                Web
                                            @elseif($admissionStudent->course == 'digital')
                                                ADM
                                            @else
                                                Eng
                                            @endif
                                        </td>
                                        <td>{{ $admissionStudent->batch_no ?? '' }}</td>
                                        <td>{{ $admissionStudent->moneyReceipt->total_fee ?? '' }}Tk.</td>
                                        <td>{{ $admissionStudent->moneyReceipt->advance ?? '' }}Tk.</td>
                                        <td>{{ $admissionStudent->moneyReceipt->today_pay ?? 'Not yet' }}</td>
                                        <td>{{ $admissionStudent->moneyReceipt->due ?? '' }}Tk.</td>
                                        <td>{{ $admissionStudent->note ?? '' }}</td>
                                        {{-- <td width="15%">{{ $admissionStudent->other_admission_note ?? '' }}</td> --}}
                                        {{-- <td>
                                            @if($admissionStudent->is_reject == 0)
                                                <a href="{{ url('/admin/student/reject/'.$admissionStudent->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bx bx-check-circle"></i>
                                                </a>
                                            @endif
                                            @if($admissionStudent->moneyReceipt->due == 0)
                                                <a href="#" class="btn btn-sm btn-success">
                                                    <i class="bx bx-check-circle"></i>
                                                </a>
                                            @else
                                                <a href="{{ url('/admin/admission/student/info/'.$admissionStudent->moneyReceipt->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="bx bx-user-circle"></i>
                                                </a>
                                            @endif
                                                <a href="{{ url('/admin/admission/student/info/edit/'.$admissionStudent->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>
                                                <a href="{{ url('/admin/admission/student/info/delete/'.$admissionStudent->id) }}" onclick="return confirm('Are you sure delete this student info ?')" class="btn btn-sm btn-danger">
                                                    <i class="bx bx-trash-alt"></i>
                                                </a>
                                        </td> --}}
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
