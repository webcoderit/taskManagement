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
	            		<div class="salary-form-wrapper">
		            		<form class="form-group">
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
		            					<label for="employe" style="font-weight: 600;margin-bottom: 10px;">Select Employe</label><br>
					                    <select name="employe" id="employeName" class="form-control" style="margin-bottom: 20px;">
					                        <option selected disabled>--- Select Employe ---</option>
					                        <option value="saidul">Saidul Islam</option>
					                        <option value="shariar">Shariar Iqbal</option>
					                        <option value="abdullah">Abdullah Al Mamun</option>
					                        <option value="ashik">Ashikur Rahman</option>
					                        <option value="ripon">MD. Ripon Mia</option>
					                        <option value="saki">Al-Amin Saki</option>
					                    </select>
		            				</div>
		            				<div class="col-md-3">
		            					<label for="salary" style="font-weight: 600;margin-bottom: 10px;">
					                    	Salary
					                    </label><br>
					                    <input type="number" name="salary" class="form-control" placeholder="Salary">
		            				</div>
		            				<div class="col-md-2" style="display: flex;align-items: center;">
				                        <button type="submit" class="btn btn-success">Submit</button>
		            				</div>
		            				<div class="col-md-6 m-auto">
		            					<div class="row">
		            						 <div class="col-md-9">
				            					<label for="search" style="font-weight: 600;margin-bottom: 10px;">
							                    	Search
							                    </label><br>
				            					<input type="text" name="search" class="form-control" placeholder="Search">
				            				</div>
				            				<div class="col-md-3" style="display: flex;align-items: flex-end;">
				            					<button type="submit" class="btn btn-primary">Submit</button>
				            				</div>
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
	                                <th>Phone</th>
	                                <th>Action</th>
	                            </tr>
	                            </thead>
	                            <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $employee->full_name }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>
                                            <a href="{{ url('/salary/pay') }}" class="btn btn-sm btn-success">
                                                <i class="bx bx-edit-alt"></i>
                                                Pay
                                            </a>
                                            <a href="{{ url('/salary/advance') }}" class="btn btn-sm btn-danger">
                                                <i class="bx bx-edit-alt"></i>
                                                Advance
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
