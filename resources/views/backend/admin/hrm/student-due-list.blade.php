@extends('backend.admin.hr-master')

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
	                            <li class="breadcrumb-item"><a href="{{ url('/admin/hr/dashboard') }}"><i class="bx bx-home-alt"></i></a>
	                            </li>
	                            <li class="breadcrumb-item active" aria-current="page">Student Due List</li>
	                        </ol>
	                    </nav>
	                </div>
	            </div>
	            <form class="form-group" action="{{ url('/admin/student/due/list') }}" method="get">
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
								<a href="{{ url('/admin/student/due/list') }}" class="input-group-text btn btn-danger">
									Clear
								</a>
							</div>
						</div>
						<div class="col-md-3">
							<label for="batch" style="font-weight: 600; margin-bottom: 10px;">
								Total Student:
							</label><br>
							@if(isset($admissionDueStudents) > 0)
								<span class="total-student-count">
									{{ count($admissionDueStudents) }}
								</span>
							@endif
						</div>
					</div>
				</form>
	            <div class="card">
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table id="" class="table table-striped table-bordered">
	                            <thead>
	                            <tr>
	                                <th>SL</th>
	                                <th>Marketing Officer Name</th>
	                                <th>Name</th>
	                                <th>Email</th>
	                                <th>Phone</th>
                                    {{-- <th>Student FB ID</th> --}}
	                                <th>Course Name</th>
	                                <th>Batch No</th>
	                                <th>Course Fee</th>
	                                <th>Advance</th>
	                                <th>Due</th>
	                                <th>Due Opinion</th>
	                                <th>Admission Opinion</th>
	                                <th>Action</th>
	                            </tr>
	                            </thead>
	                            <tbody>
                                @foreach($admissionDueStudents as $admissionStudent)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $admissionStudent->user->full_name?? session()->get('name') }}</td>
                                        <td>{{ $admissionStudent->s_name?? '' }}</td>
                                        <td>{{ $admissionStudent->s_email ?? '' }}</td>
                                        <td>{{ $admissionStudent->s_phone ?? '' }}</td>
                                        {{-- <td>
                                            <a href="{{ $admissionStudent->fb_id ?? '' }}" target="_blank">{{ $admissionStudent->fb_id ?? '' }}</a>
                                        </td> --}}
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
                                        <td>{{ $admissionStudent->other_admission_note ?? '' }}</td>
                                        <td>
                                            @if($admissionStudent->is_reject == 0)
                                                <a href="{{ url('/admin/student/reject/'.$admissionStudent->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bx bx-check-circle"></i>
                                                </a>
                                            @endif
                                            @if($admissionStudent->moneyReceipt->due == 0)
                                               
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
