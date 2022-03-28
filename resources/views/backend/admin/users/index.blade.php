@extends('backend.admin.master')

@section('content')
    <h6 class="mb-0 text-uppercase">Form with icons</h6>
    <hr/>
    <div class="card border-top border-0 border-4 border-danger">
        <div class="card-body p-5">
            <div class="card-title d-flex align-items-center">
                <div><i class="bx bxs-user me-1 font-22 text-danger"></i>
                </div>
                <h5 class="mb-0 text-danger">User Registration</h5>
            </div>
            <hr>
            <form class="row g-3">
                <div class="col-md-6">
                    <label for="inputLastName1" class="form-label">First Name</label>
                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                        <input type="text" class="form-control border-start-0" id="inputLastName1" placeholder="First Name" />
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="inputLastName2" class="form-label">Last Name</label>
                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                        <input type="text" class="form-control border-start-0" id="inputLastName2" placeholder="Last Name" />
                    </div>
                </div>
                <div class="col-12">
                    <label for="inputPhoneNo" class="form-label">Phone No</label>
                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-microphone' ></i></span>
                        <input type="text" class="form-control border-start-0" id="inputPhoneNo" placeholder="Phone No" />
                    </div>
                </div>
                <div class="col-12">
                    <label for="inputEmailAddress" class="form-label">Email Address</label>
                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                        <input type="text" class="form-control border-start-0" id="inputEmailAddress" placeholder="Email Address" />
                    </div>
                </div>
                <div class="col-12">
                    <label for="inputChoosePassword" class="form-label">Choose Password</label>
                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-lock-open' ></i></span>
                        <input type="text" class="form-control border-start-0" id="inputChoosePassword" placeholder="Choose Password" />
                    </div>
                </div>
                <div class="col-12">
                    <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-lock' ></i></span>
                        <input type="text" class="form-control border-start-0" id="inputConfirmPassword" placeholder="Confirm Password" />
                    </div>
                </div>
                <div class="col-12">
                    <label for="inputAddress3" class="form-label">Address</label>
                    <textarea class="form-control" id="inputAddress3" placeholder="Enter Address" rows="3"></textarea>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck2">
                        <label class="form-check-label" for="gridCheck2">Check me out</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-danger px-5">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection