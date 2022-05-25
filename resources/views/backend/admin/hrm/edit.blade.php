@extends('backend.admin.hr-master')

@section('content')
	<section class="student-due-edit-section" style="padding: 1.5rem;margin-left: 20px;">
			<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	            <div class="breadcrumb-title pe-3">Student List</div>
	            <div class="ps-3">
	                <nav aria-label="breadcrumb">
	                    <ol class="breadcrumb mb-0 p-0">
	                        <li class="breadcrumb-item"><a href="{{ url('/admin/hr/dashboard') }}"><i class="bx bx-home-alt"></i></a>
	                        </li>
	                        <li class="breadcrumb-item active" aria-current="page">Due Collection</li>
	                    </ol>
	                </nav>
	            </div>
	        </div>
	        <h6 class="mb-0 text-uppercase">Due Collection</h6>
	        <hr/>
		<div class="container">
			<div class="row">
				<div class="col-md-6 m-auto">
					<div class="student-due-edit-wrapper" style="margin-top: 40px;padding: 20px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
						<div class="foem-header-wpapper">
							<div>
								<h6 class="mb-0 text-uppercase">Due Collection</h6>
							</div>
							<div>
								<a href="{{ url('admin/student/list') }}" class="back-btn-inner">
									<i class="bx bx-arrow-to-left"></i>
									Back
								</a>
							</div>
						</div>
						<hr>
						<form class="student-due-edit-form form-group" action="{{ url('/admin/due/clear/'.$courseDueCollection->id) }}" method="post">
                            @csrf

							<label style="font-weight: 600;">Total Fee</label><br>
							<input type="number" name="course_fee" id="course_fee" value="{{ $courseDueCollection->total_fee }}" readonly placeholder="Total Fee" class="form-control">
							<label style="font-weight: 600;">Advance</label><br>
							<input type="number" name="advance" id="advance" value="{{ $courseDueCollection->advance }}" readonly placeholder="Advance" class="form-control">
							<label style="font-weight: 600;">Due</label><br>
							<input type="number" name="due" id="due" value="{{ $courseDueCollection->due }}" readonly placeholder="Due" class="form-control">
							<label style="font-weight: 600;">Payment</label><br>
                            @if($courseDueCollection->due == 0)
                                <input type="number" name="due_payment" id="due_payment" placeholder="Payment" disabled class="form-control">
                            @else
                                <input type="number" name="due_payment" id="due_payment" placeholder="Payment" onblur="calculate()" class="form-control">
                                <label style="font-weight: 600;">Student Note</label><br>
                                <textarea class="form-control" name="note" rows="5" placeholder="Student opinion here..."></textarea>
                            @endif
                            @if($courseDueCollection->due == 0)
                                <div style="text-align: center;margin-top: 20px;">
                                    <button type="submit" class="btn btn-success" disabled>Submit</button>
                                </div>
                            @else
                                <div style="text-align: center;margin-top: 20px;">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            @endif
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@push('script')
    <script>
        function calculate(){
            let dueFee = document.getElementById('due').value;
            let payment = document.getElementById('due_payment').value;
            document.getElementById('due').value = parseInt(dueFee) - parseInt(payment);
        }
    </script>
@endpush