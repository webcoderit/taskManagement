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
	            <h6 class="mb-0 text-uppercase">Student List</h6>
	            <hr/>
	            <div class="card">
	                <div class="card-body">
	                    <div class="table-responsive">
	                        <table id="example" class="table table-striped table-bordered" style="width:100%">
	                            <thead>
	                            <tr>
	                                <th>SL</th>
	                                <th>Name</th>
	                                <th>Email</th>
	                                <th>Phone</th>
	                                <th>Course Name</th>
	                                <th>Course Fee</th>
	                                <th>Advance</th>
	                                <th>Due</th>
	                                <th>Action</th>
	                            </tr>
	                            </thead>
	                            <tbody>
                                    <tr>
                                        <td>21</td>
                                        <td>Saidul Islam</td>
                                        <td>info@gmail.com</td>
                                        <td>21544651548</td>
                                        <td>Digital Marketing</td>
                                        <td>12000</td>
                                        <td>5000</td>
                                        <td>7000</td>
                                        <td>                                        
                                        	<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#studentList">
                                                <i class="bx bx-edit-alt"></i>
                                                View
                                            </a>
                                        </td>
                                    </tr>
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>

	            {{-- Modal Html Start --}}	            
					<div class="modal fade" id="studentList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
						    <div class="modal-content">
							    <div class="modal-header border-bottom-0">
							        <h5 class="modal-title" id="exampleModalLabel">Student List</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: #fff;border-radius: 5px;padding: 0px 7px;border: 2px solid #f16522;">
							          <span aria-hidden="true" style="color: #f16522">&times;</span>
							        </button>
							    </div>
							    <form>
							        <div class="modal-body">
								        <div class="form-group" style="margin-bottom: 10px;">
								            <label for="course_name" style="font-weight: 500;color: #000;margin-bottom: 5px;">Course Name</label>
								            <input type="text" class="form-control" id="course_name" placeholder="Course Name">
								        </div>
								        <div class="form-group" style="margin-bottom: 10px;">
								            <label for="course_fee" style="font-weight: 500;color: #000;margin-bottom: 5px;">Course Fee</label>
								            <input type="number" class="form-control" id="course_fee" placeholder="Course Fee">
								        </div>
								        <div class="form-group" style="margin-bottom: 10px;">
								            <label for="advance" style="font-weight: 500;color: #000;margin-bottom: 5px;">Advance</label>
								            <input type="number" class="form-control" id="advance" placeholder="Advance">
								        </div>
								        <div class="form-group" style="margin-bottom: 10px;">
								            <label for="due" style="font-weight: 500;color: #000;margin-bottom: 5px;">Due</label>
								            <input type="number" class="form-control" id="due" placeholder="Due">
								        </div>

								        <div class="form-group" style="margin-bottom: 10px;">
								            <label for="payment" style="font-weight: 500;color: #000;margin-bottom: 5px;">Payment</label>
								            <input type="number" class="form-control" id="payment" placeholder="Payment">
								        </div>
							        </div>
							        <div class="modal-footer border-top-0 d-flex justify-content-center">
								        <button type="submit" class="btn btn-success" style="background-color: #f16522;border: 1px solid #f16522;">
								          	Submit
								        </button>
							        </div>
							    </form>
						    </div>
						</div>
					</div>
	            {{-- Modal Html End --}}
	        </div>
	    </div>
	</div>
@endsection
