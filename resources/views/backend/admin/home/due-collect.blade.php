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
                
                </div>
	            <hr/>
	            <div class="card">
	                <div class="card-body">
	                    <div class="table-responsive">
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
	                                <th>Advance</th>
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
                                                {{ $admissionStudent->moneyReceipt->updated_at->format('Y-m-d') }}
                                            @else
                                                <span>Pay not yet</span>
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
