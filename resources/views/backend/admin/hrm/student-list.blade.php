@extends('backend.admin.hr-master')

@section('content')
	<div class="wrapper">
	    <div class="page-wrapper" style="margin-left: 20px!important;">
	        <div class="page-content">
	            <!--breadcrumb-->
	            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	                <div class="breadcrumb-title pe-3">Student List</div>
	                <div class="ps-3">
	                    <nav aria-label="breadcrumb">
	                        <ol class="breadcrumb mb-0 p-0">
	                            <li class="breadcrumb-item"><a href="{{ url('/admin/hr/dashboard') }}"><i class="bx bx-home-alt"></i></a>
	                            </li>
	                            <li class="breadcrumb-item active" aria-current="page">Student List</li>
	                        </ol>
	                    </nav>
	                </div>
	            </div>
	            <!--end breadcrumb-->
                <div class="col-md-12">
                    <div class="row">
                        <form action="{{ url('/admin/student/list') }}" method="get">
                            <div class="col-md-6 m-auto">
                                <div class="input-group mb-3">
                                    @csrf
                                    <select class="form-control" name="batch_no">
                                        <option selected disabled>----Select A Batch No----</option>
                                        @foreach($admissionStudentsBatch as $admissionStudentBatch)
                                            <option value="{{ $admissionStudentBatch[0]->batch_no }}">{{ ucfirst($admissionStudentBatch[0]->course) }} - {{ ucfirst($admissionStudentBatch[0]->batch_no) }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
                                    <a href="{{ url('/admin/student/list') }}" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
	            <hr/>
	            <div class="card">
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table id="" class="table table-striped table-bordered" style="width:100%">
	                            <thead>
	                            <tr>
	                                <th>SL</th>
	                                <th>Marketing Officer Name</th>
	                                <th>Name</th>
	                                <th>Email</th>
	                                <th>Phone</th>
	                                <th>Course Name</th>
	                                <th>Course Fee</th>
	                                <th>Advance</th>
	                                <th>Due</th>
	                                <th>Opinion</th>
	                                <th>Action</th>
	                            </tr>
	                            </thead>
	                            <tbody>
                                @foreach($admissionStudents as $admissionStudent)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $admissionStudent->user->full_name?? '' }}</td>
                                        <td>{{ $admissionStudent->s_name?? '' }}</td>
                                        <td>{{ $admissionStudent->s_email ?? '' }}</td>
                                        <td>{{ $admissionStudent->s_phone ?? '' }}</td>
                                        <td>
                                            @if($admissionStudent->course == 'web')
                                                Full stack web development
                                            @elseif($admissionStudent->course == 'digital')
                                                Advance digital marketing
                                            @else
                                                Communication english
                                            @endif
                                        </td>
                                        <td>{{ $admissionStudent->moneyReceipt->total_fee ?? '' }}</td>
                                        <td>{{ $admissionStudent->moneyReceipt->advance ?? '' }}</td>
                                        <td>{{ $admissionStudent->moneyReceipt->due ?? '' }}</td>
                                        <td>{{ $admissionStudent->note ?? '' }}</td>
                                        <td>
                                            @if($admissionStudent->moneyReceipt->due == 0)
                                                <a href="#" class="btn btn-sm btn-success">
                                                    Paid
                                                </a>
                                            @else
                                                <a href="{{ url('/admin/admission/student/info/'.$admissionStudent->moneyReceipt->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="bx bx-edit-alt"></i>
                                                    Due
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
	                            </tbody>
	                        </table>
                            {{ $admissionStudents->links() }}
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection
