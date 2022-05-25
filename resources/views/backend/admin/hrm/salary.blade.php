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
	                    <div class="table-responsive">
	                        <table id="" class="table table-striped table-bordered" style="width:100%">
	                            <thead>
	                            <tr>
	                                <th>SL</th>
	                                <th>Month</th>
	                                <th>Name</th>
	                                <th>Salary Amount</th>
	                                <th>Status</th>
	                                <th>Action</th>
	                            </tr>
	                            </thead>
	                            <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Octobar</td>
                                        <td>Saidul Islam</td>
                                        <td>5000</td>
                                        <td></td>
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
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection
