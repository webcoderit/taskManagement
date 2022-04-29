@extends('backend.admin.master')

@section('content')
	<section class="money-receipt-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 m-auto">
					<div class="money-receipt-form-wrapper">
						<div class="addmission-form-heading">
                            <h2 class="institute-name">Web<span>coder</span>-it</h2>
                            <address>
                                House#06, Level#03 Road-1/A, Sector#09 Housebuilding, Uttara Dhaka-1230
                            </address>
                            <span>
                                <a href="tel:01648177071">
                                    01648177071 ,
                                </a>
                            </span>
                            <span>
                                <a href="tel:01814812233">
                                    01814812233
                                </a>
                            </span><br>
                            <span>
                                <a href="https://webcoder-it.com/" target="_blank" title="Website">
                                    www.webcoder-it.com ,
                                </a>
                            </span>
                            <span>
                                <a href="mailto:webcoderit@gmail.com" title="Gmail Id">
                                    webcoderit@gmail.com
                                </a>
                            </span>
                        </div> 
						<form action="#" method="#" class="money-receipt-form form-group">
							<label for="name">Name</label>
                             <input type="text" name="name" placeholder="Name" class="form-control">
                             <label for="stu_id">Student Id</label><br>
                             <input type="text" name="stu_id" placeholder="Student Id" class="form-control">
                             <label for="address">Address</label><br>
                             <input type="text" name="address" placeholder="Address" class="form-control">
                             <label for="course_name">Course Name</label><br>
                             <input type="text" name="course_name" placeholder="Course Name" class="form-control">
                             <div class="row">
                             	<div class="col-md-6">
                             		<label for="cash">By Cash/Chaque</label><br>
                             		<input type="text" name="cash" placeholder="By Cash/Chaque" class="form-control">
                             	</div>
                             	<div class="col-md-6">
                             		<label for="bank">Bank</label><br>
                             		<input type="text" name="bank" placeholder="Bank" class="form-control">
                             	</div>
                             	<div class="col-md-6">
                             		<label for="date">Date</label><br>
                             		<input type="date" name="date" placeholder="Date" class="form-control">
                             	</div>
                             	<div class="col-md-6">
                             		<label for="word">In Word</label><br>
                             		<input type="text" name="word" placeholder="In Word" class="form-control">
                             	</div>
                             	<div class="col-md-4">
                             		<label for="total_taka">Total Taka</label><br>
                             		<input type="text" name="total_taka" placeholder="Total Taka" class="form-control">
                             	</div>
                             	<div class="col-md-4">
                             		<label for="advance">Advance</label><br>
                             		<input type="text" name="advance" placeholder="Advance" class="form-control">
                             	</div>
                             	<div class="col-md-4">
                             		<label for="due">Due</label><br>
                             		<input type="text" name="due" placeholder="Due" class="form-control">
                             	</div>
                             	<div class="col-md-6">
                             		<label for="receive_by">Receive By</label><br>
                             		<input type="text" name="receive_by" placeholder="Receive By" class="form-control">
                             	</div>
                             	<div class="col-md-6">
                             		<label for="authorised_by">Authorised By</label><br>
                             		<input type="text" name="authorised_by" placeholder="Authorised By" class="form-control">
                             	</div>
                             </div>
                             <div class="money-receipt-form-btn-outer text-center mt-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
