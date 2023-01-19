@extends('backend.admin.hr-master')

@push('style')
    <style>
        select[readonly]
        {
            pointer-events: none;
        }
    </style>
@endpush

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
							<input type="number" readonly name="total_fee" readonly id="course_fee" value="{{ $courseDueCollection->total_fee }}" placeholder="Total Fee" class="form-control">
							<label style="font-weight: 600;">First Payment</label><br>
							<input type="number" readonly name="advance" readonly id="advance" value="{{ $courseDueCollection->advance }}" placeholder="Advance" class="form-control">
							<label style="font-weight: 600;">Total Due</label><br>
							<input type="number" name="due" readonly id="due" value="{{ $courseDueCollection->due }}" placeholder="Due" class="form-control">
                            @if($courseDueCollection->second_due_payment != null)
                                <label style="font-weight: 600;">2nd Payment</label><br>
                                <input type="number" name="second_payment" readonly id="second_payment" value="{{ $courseDueCollection->second_due_payment }}" placeholder="second_due_payment" class="form-control">
                            @endif
                            @if($courseDueCollection->third_due_payment != null)
                                <label style="font-weight: 600;">3rd Payment</label><br>
                                <input type="number" name="third_payment" readonly id="third_payment" value="{{ $courseDueCollection->third_due_payment }}" placeholder="third_due_payment" class="form-control">
                            @endif
                            @if($courseDueCollection->four_due_payment != null)
                                <label style="font-weight: 600;">2nd Payment</label><br>
                                <input type="number" name="four_payment" readonly id="four_payment" value="{{ $courseDueCollection->four_due_payment }}" placeholder="four_due_payment" class="form-control">
                            @endif
                            @if($courseDueCollection->five_due_payment != null)
                                <label style="font-weight: 600;">3rd Payment</label><br>
                                <input type="number" name="five_payment" readonly id="five_payment" value="{{ $courseDueCollection->five_due_payment }}" placeholder="five_due_payment" class="form-control">
                            @endif
                            <div id="paymentTime">
                                <label style="font-weight: 600;">Select Payment Type Option</label>
                                <select class="form-control mt-2" name="payment_type_option" id="payment_type_option" onclick="paymentTypeOption(this.value)" required>
                                    <option selected disabled>Select Payment Type Option</option>
                                    <option id="second" value="2" {{ $courseDueCollection->second_due_payment != null ? 'disabled' : '' }}>2nd Payment</option>
                                    <option id="third" value="3" {{ $courseDueCollection->third_due_payment != null ? 'disabled' : '' }}>3rd Payment</option>
                                    <option id="four" value="4" {{ $courseDueCollection->four_due_payment != null ? 'disabled' : '' }}>4th Payment</option>
                                    <option id="five" value="5" {{ $courseDueCollection->five_due_payment != null ? 'disabled' : '' }}>5th Payment</option>
                                </select>
                            </div>
							<label style="font-weight: 600;">Payment</label><br>
                            @if($courseDueCollection->due == 0)
                                <input type="number" name="due_payment" id="due_payment" placeholder="Payment" disabled class="form-control">
                            @else
                                <input type="number" name="second_due_payment" id="second_due_payment" placeholder="second_due_payment" class="form-control" style="display: none;">
                                <input type="number" name="third_due_payment" id="third_due_payment" placeholder="third_due_payment" class="form-control" style="display: none;">
                                <input type="number" name="four_due_payment" id="four_due_payment" placeholder="four_due_payment" class="form-control" style="display: none;">
                                <input type="number" name="five_due_payment" id="five_due_payment" placeholder="five_due_payment" class="form-control" style="display: none;">

{{--								<div id="payType" style="display: none;">--}}
{{--                                    <label style="font-weight: 600;">Is Pay</label>--}}
{{--                                    <select class="form-control mt-2" name="is_pay" id="isPay" onclick="isPayStudent(this.value)" required readonly>--}}
{{--                                        <option selected disabled>Select A Option</option>--}}
{{--                                        <option id="yes" value="1">Paid</option>--}}
{{--                                        <option id="partial" value="1">Partial Paid</option>--}}
{{--                                        <option id="no" value="0">No</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
                                <div id="note" style="display: block">
									<label style="font-weight: 600;">Student Note</label><br>
                                	<textarea class="form-control" name="note" rows="5" placeholder="Student opinion here..."></textarea>
								</div>
                            @endif
{{--                            <div class="form-check mt-3">--}}
{{--                                <input class="form-check-input" type="checkbox" name="is_paid" onclick="isDiscountPaid(this)" value="1" id="isPaid">--}}
{{--                                <label class="form-check-label" for="isPaid" style="font-weight: 600;">--}}
{{--                                    Is Paid--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div id="disCountNote" style="display: none">--}}
{{--                                <label style="font-weight: 600;">Is paid note</label><br>--}}
{{--                                <textarea class="form-control" name="is_paid_note" rows="5" placeholder="Is paid note..."></textarea>--}}
{{--                            </div>--}}
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function paymentTypeOption(e){
            //console.log(e)
            if(e == 2){
                document.getElementById('second_due_payment').style.display = "block";
                document.getElementById('third_due_payment').style.display = "none";
                document.getElementById('four_due_payment').style.display = "none";
                document.getElementById('five_due_payment').style.display = "none";
            }else if(e == 3){
                document.getElementById('third_due_payment').style.display = "block";
                document.getElementById('second_due_payment').style.display = "none";
                document.getElementById('four_due_payment').style.display = "none";
                document.getElementById('five_due_payment').style.display = "none";
            }else if(e == 4){
                document.getElementById('four_due_payment').style.display = "block";
                document.getElementById('third_due_payment').style.display = "none";
                document.getElementById('second_due_payment').style.display = "none";
                document.getElementById('five_due_payment').style.display = "none";
            }else if(e == 5){
                document.getElementById('five_due_payment').style.display = "block";
                document.getElementById('four_due_payment').style.display = "none";
                document.getElementById('third_due_payment').style.display = "none";
                document.getElementById('second_due_payment').style.display = "none";
            }
        }
        function calculate(){
            // let dueFee = document.getElementById('due').value;
            // let secondPayment = document.getElementById('second_due_payment').value;
            // let thirdPayment = document.getElementById('third_due_payment').value;
            // let fourPayment = document.getElementById('four_due_payment').value;
            // let fivePayment = document.getElementById('five_due_payment').value;
            // let note = document.getElementById('note');
            // let paymentType = document.getElementById('payType');
            // document.getElementById('due').value = parseInt(dueFee) - parseInt(secondPayment);

            // if(dueFee < secondPayment){
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Oops ! Try again',
            //         text: 'Something went wrong! Due Amount and Due Payment Amount Mismatched',
            //         showConfirmButton: false,
            //         footer: '<a href="" style="color: white; text-decoration: none; background-color: red; padding: 10px; width: 100px; border-radius: 5px; text-align: center">Cancel</a>',
            //         allowOutsideClick: false,
            //         allowEscapeKey: false,
            //     })
            // }else if(dueFee < thirdPayment){
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Oops ! Try again',
            //         text: 'Something went wrong! Due Amount and Due Payment Amount Mismatched',
            //         showConfirmButton: false,
            //         footer: '<a href="" style="color: white; text-decoration: none; background-color: red; padding: 10px; width: 100px; border-radius: 5px; text-align: center">Cancel</a>',
            //         allowOutsideClick: false,
            //         allowEscapeKey: false,
            //     })
            // }else if(dueFee < fourPayment){
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Oops ! Try again',
            //         text: 'Something went wrong! Due Amount and Due Payment Amount Mismatched',
            //         showConfirmButton: false,
            //         footer: '<a href="" style="color: white; text-decoration: none; background-color: red; padding: 10px; width: 100px; border-radius: 5px; text-align: center">Cancel</a>',
            //         allowOutsideClick: false,
            //         allowEscapeKey: false,
            //     })
            // }else if(dueFee < fivePayment){
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Oops ! Try again',
            //         text: 'Something went wrong! Due Amount and Due Payment Amount Mismatched',
            //         showConfirmButton: false,
            //         footer: '<a href="" style="color: white; text-decoration: none; background-color: red; padding: 10px; width: 100px; border-radius: 5px; text-align: center">Cancel</a>',
            //         allowOutsideClick: false,
            //         allowEscapeKey: false,
            //     })
            // }
            //
            // if(dueFee > secondPayment){
            //     document.getElementById('partial').selected = true;
            //     paymentType.style.display = "block";
            // }
            // if(dueFee > thirdPayment){
            //     document.getElementById('partial').selected = true;
            //     paymentType.style.display = "block";
            // }
            // if(dueFee > fourPayment){
            //     document.getElementById('partial').selected = true;
            //     paymentType.style.display = "block";
            // }
            // if(dueFee > fivePayment){
            //     document.getElementById('partial').selected = true;
            //     paymentType.style.display = "block";
            // }
            //
            // if(dueFee == secondPayment){
            //     document.getElementById('yes').selected = true;
            //     //dueFee = 0;
            //     note.style.display = "none";
            //     paymentType.style.display = "block";
            // }if(dueFee ==  thirdPayment){
            //     document.getElementById('yes').selected = true;
            //     //dueFee = 0;
            //     note.style.display = "none";
            //     paymentType.style.display = "block";
            // }if(dueFee == fourPayment){
            //     document.getElementById('yes').selected = true;
            //     //dueFee = 0;
            //     note.style.display = "none";
            //     paymentType.style.display = "block";
            // }if(dueFee == fivePayment){
            //     document.getElementById('yes').selected = true;
            //     //dueFee = 0;
            //     note.style.display = "none";
            //     paymentType.style.display = "block";
            // }
        }



		// function isPayStudent(e){
		// 	if(e == 0){
		// 		note.style.display = "block";
		// 	}else{
		// 		note.style.display = "none";
		// 	}
		// }
        //
        //
        // function isDiscountPaid(discount){
        //     let discountNoteIsPaid = document.getElementById('disCountNote');
        //     let dueFeeClear = document.getElementById('due');
        //     discountNoteIsPaid.style.display = discount.checked ? "block" : "none";
        //     dueFeeClear.value = '0.00'
        // }
    </script>
@endpush
