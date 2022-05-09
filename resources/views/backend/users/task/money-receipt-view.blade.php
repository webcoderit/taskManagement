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
                        <div style="text-align:end">
                            <span class="money-receipt-view-label">Admission Date :</span>
                            <span class="money-receipt-view-value">{{ $moneyReceiptView->admission_date }}</span>
                        </div>
                    </div>
                    <div class="money-receipt-view">
                        <div style="display: flex; align-items: center; justify-content: space-between;margin-bottom: 15px;">
                            <div>
                                <span class="money-receipt-view-label">Student Name :</span>
                                <span class="money-receipt-view-value">{{ $moneyReceiptView->admissionForm->s_name ?? '' }}</span>
                            </div>
                            <div>
                                <span class="money-receipt-view-label">Student ID :</span>
                                <span class="money-receipt-view-value">46354</span>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 40px;">
                            <div>
                                <span class="money-receipt-view-label">Total Fee :</span>
                                <span class="money-receipt-view-value">{{ $moneyReceiptView->total_fee }} tk</span>
                            </div>
                            <div>
                                <span class="money-receipt-view-label">Advance :</span>
                                <span class="money-receipt-view-value">{{ $moneyReceiptView->advance }} tk</span>
                            </div>
                            <div>
                                <span class="money-receipt-view-label">Due :</span>
                                <span class="money-receipt-view-value">{{ $moneyReceiptView->due }} tk</span>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <div>
                                <span class="money-receipt-view-label">Received By :</span>
                                <span class="money-receipt-view-value">{{ auth()->user()->full_name }}</span>
                            </div>
                            <div>
                                <span class="money-receipt-view-label">Authorised By :</span>
                                <span class="money-receipt-view-value">WebCoder-it</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
