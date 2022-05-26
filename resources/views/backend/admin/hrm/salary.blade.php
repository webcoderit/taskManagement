@extends('backend.admin.hr-master')

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
	                            <li class="breadcrumb-item"><a href="{{ url('/admin/hr/dashboard') }}"><i class="bx bx-home-alt"></i></a>
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
		            		<form class="form-group" action="{{ url('/salary/submit') }}" method="post">
                                @csrf
		            			<div class="row">
		            				<div class="col-md-3">
		            					<label for="month" style="font-weight: 600;margin-bottom: 10px;">Select Month</label><br>
				            			<select name="month" id="month" class="form-control" style="margin-bottom: 20px;">
					                        <option selected disabled>--- Select Month ---</option>
					                        <option value="january">January</option>
					                        <option value="february">February</option>
					                        <option value="march">March</option>
					                        <option value="april">April</option>
					                        <option value="may">May</option>
					                        <option value="june">June</option>
					                        <option value="july">July</option>
					                        <option value="august">August</option>
					                        <option value="september">September</option>
					                        <option value="october">October</option>
					                        <option value="november">November</option>
					                        <option value="december">December</option>
					                    </select>
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
                                <div class="col-md-8 m-auto">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="month" style="font-weight: 600;margin-bottom: 10px;">Monthly Salary Amount</label><br>
                                            <select name="month" id="month" class="form-control" style="margin-bottom: 20px;">
                                                <option selected disabled>--- Select Month ---</option>
                                                <option value="january">January</option>
                                                <option value="february">February</option>
                                                <option value="march">March</option>
                                                <option value="april">April</option>
                                                <option value="may">May</option>
                                                <option value="june">June</option>
                                                <option value="july">July</option>
                                                <option value="august">August</option>
                                                <option value="september">September</option>
                                                <option value="october">October</option>
                                                <option value="november">November</option>
                                                <option value="december">December</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2" style="margin-top: 30px;">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        <div class="col-md-3 p-0">
                                            <a href="#" class="salary-form-btn">
                                            	Clear
                                            </a>
                                        </div>
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
                                        <td>{{ ucfirst($salary->month) }}</td>
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
