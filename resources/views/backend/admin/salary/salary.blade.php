@extends('backend.admin.admin-master')

@section('content')
	<div class="wrapper">
	    <div class="page-wrapper" style="margin-left: 20px!important;">
	        <div class="page-content">
	            <!--breadcrumb-->
	            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	                <div class="breadcrumb-title pe-3">Salary List</div>
	                <div class="ps-3">
	                    <nav aria-label="breadcrumb">
	                        <ol class="breadcrumb mb-0 p-0">
	                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
	                            </li>
	                            <li class="breadcrumb-item active" aria-current="page">Salary</li>
	                        </ol>
	                    </nav>
	                </div>
	            </div>
	            <!--end breadcrumb-->
	            <hr/>
	            <div class="card">
	            	<div class="card-body">
                        @if(Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Warning!</strong> {{ Session::get('error') }}.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                            @if(Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{ Session::get('success') }}.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
	            		<div class="salary-form-wrapper">
		            		<form class="form-group" action="{{ url('/admin/salary/submit') }}" method="post">
                                @csrf
		            			<div class="row">
		            				<div class="col-md-3">
		            					<label for="month" style="font-weight: 600;margin-bottom: 10px;">Select Month</label><br>
                                        <input type="month" name="month" class="form-control" placeholder="Select a month">
		            				</div>
		            				<div class="col-md-4">
		            					<label for="employee" style="font-weight: 600;margin-bottom: 10px;">Select Employee</label><br>
					                    <select name="user_id" id="employeName" class="form-control" style="margin-bottom: 20px;">
					                        <option selected disabled>--- Select Employee ---</option>
                                            @foreach($employees as $employee)
					                        <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
                                            @endforeach
					                    </select>
		            				</div>
		            				<div class="col-md-3">
		            					<label for="salary" style="font-weight: 600;margin-bottom: 10px;">
					                    	Salary
					                    </label><br>
					                    <input type="number" name="salary" class="form-control" placeholder="Salary">
		            				</div>
		            				<div class="col-md-2" style="margin-top: 30px;">
				                        <button type="submit" class="btn btn-success">Submit</button>
		            				</div>
		            			</div>
		            		</form>
                            <form action="{{ url('/salary') }}" method="get">
                                @csrf
                                <div class="col-md-6 m-auto">
                                    <div class="input-group">
                                    	<label for="month" style="font-weight: 600;margin-right: 10px;padding: 8px 0;">Monthly Salary : </label>
                                        <input type="month" name="month" class="form-control" placeholder="Select a month">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ url('/admin/salary/list') }}" class="input-group-text btn btn-danger">
                                        	Clear
                                        </a>
                                    </div>
                                </div>
                            </form>
		            	</div>
	            	</div>
	            </div>
	            <div class="card">
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table id="" class="table table-striped table-bordered" style="width:100%">
	                            <thead>
	                            <tr>
	                                <th>SL</th>
	                                <th>Name</th>
	                                <th>Month</th>
	                                <th>Amount</th>
	                            </tr>
	                            </thead>
	                            <tbody>
                                @php
                                    $sum = 0
                                @endphp
                                @foreach($salaries as $salary)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $salary->user->full_name ?? '' }}</td>
                                        <td>{{ date('Y-M', strtotime($salary->month)) }}</td>
                                        <td>{{ number_format($salary->salary,2) }} Tk.</td>
                                    </tr>
                                    @php
                                        $sum += $salary->salary
                                    @endphp
                                @endforeach
                                <tr>
                                    <td width="8%">
                                        <span></span>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td width="12%">
                                        <span style="font-weight: bold">Total : {{ number_format($sum,2) }} Tk.</span>
                                    </td>
                                </tr>
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection
