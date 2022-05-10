@extends('backend.admin.master')

@section('content')
<section class="money-receipt-view-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="money-receipt-view-wrapper">
                    <div class="money-receipt-view-heading">
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
                        <div>
                            <h4 class="money-receipt-view-title">
                                Money Receipt
                            </h4>
                        </div>
                    </div>
                    <form class="form-group money-receipt-view" action="" method="" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                 <label for="student_name">Student Name</label>
                                 <input type="text" name="s_name" placeholder="Student Name" class="form-control">
                            </div>
                            <div class="col-md-4">
                                 <label for="student_id">Student ID</label><br>
                                 <input type="text" name="student_id" placeholder="Student ID" class="form-control">
                            </div>
                            <div class="col-md-4">
                                 <label for="date">Addmission Date</label><br>
                                 <input type="date" name="date" placeholder="Addmission Date" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="total_fee">Total Fee</label><br>
                                <input type="text" name="total_fee" id="total_fee" placeholder="Total Taka" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="advance">Advance</label><br>
                                <input type="text" name="advance" id="advance" placeholder="Advance" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="due">Due</label><br>
                                <input type="text" name="due" placeholder="Due" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="received_by">Received By</label><br>
                                <input type="text" name="received_by" placeholder="Received By" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="authorised_by">Authorised By</label><br>
                                <input type="text" name="authorised_by" placeholder="Authorised By" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
