<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Money Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('backend/') }}/assets/css/style.css" />

    <style>
        @media print {
            *{
                visibility: hidden;
            }
            .money-receipt-view-wrapper,
            .money-receipt-view-wrapper *{
                visibility: visible;
            }
        }
    </style>
</head>
<body>
    <section class="money-receipt-view-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 m-auto">
                    <div class="money-receipt-view-wrapper" style="border: 1px solid #ddd;">
                        <div class="institute-address-wrapper">
                            <div class="address-title-outer">
                                <h4 class="address-title">Money Receipt</h4>
                            </div>
                            <div class="institute-address-outer">
                                <img src="{{ asset('backend/') }}/assets/logo3.png" class="institute-logo">
                                <p class="address-inner" style="font-weight: 500;">
                                    House#06, Level#03 Road-1/A, Sector#09 Housebuilding, Uttara Dhaka-1230
                                </p>
                            </div>
                        </div>
                        <div class="money-receipt-info-wrapper">
                            <div class="money-receipt-info-item">
                                <div class="stu-id">
                                    <span class="admission-form-view-label">Student ID :</span>
                                    <span>{{ ucfirst($moneyReceiptView->admissionForm->course) ?? '' }} - {{ $moneyReceiptView->admissionForm->student_id ?? '' }}</span>
                                </div>
                                <div class="admission-date">
                                    <span class="money-receipt-view-label">Admission Date :</span>
                                    <span>{{ $moneyReceiptView->admission_date->format('Y-m-d') ?? ' ' }}</span>
                                </div>
                            </div>
                            <div class="money-receipt-info-item">
                                <div>
                                    <span class="money-receipt-view-label">Student Name :</span>
                                    <span>{{ $moneyReceiptView->admissionForm->s_name ?? ' ' }}</span>
                                </div>
                                <div>
                                    <span class="money-receipt-view-label">Phone :</span>
                                    <span>{{ $moneyReceiptView->admissionForm->s_phone ?? ' ' }}</span>
                                </div>
                            </div>
                            <div class="money-receipt-info-item">
                                <div>
                                    <span class="money-receipt-view-label">
                                        Course Name :
                                    </span>
                                    <span>
                                        @if($moneyReceiptView->admissionForm->course == 'web')
                                                Full stack web development
                                            @elseif($moneyReceiptView->admissionForm->course == 'digital')
                                                Advance Digital Marketing
                                            @else
                                                Communication English
                                            @endif
                                    </span>
                                </div>
                                <div>
                                    <span class="money-receipt-view-label">Batch No :</span>
                                    <span>{{ $moneyReceiptView->admissionForm->batch_no }}</span>
                                </div>
                            </div>
                            <div class="money-receipt-info-item">
                                <div>
                                    <span class="money-receipt-view-label">Total Fee :</span>
                                    <span>{{ $moneyReceiptView->total_fee }} TK</span>
                                </div>
                                <div>
                                    <span class="money-receipt-view-label">Advance :</span>
                                    <span>{{ $moneyReceiptView->advance }} TK. <small style="color: red">( Advance & {{ ucfirst($moneyReceiptView->payment_type) }} Cost )</small> </span>
                                </div>
                                <div>
                                    <span class="money-receipt-view-label">Due :</span>
                                    <span>
                                        @if($moneyReceiptView->due == 0)
                                            Paid
                                        @else
                                            {{ $moneyReceiptView->due }} TK
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="money-receipt-info-item">
                                <div>
                                    <span class="money-receipt-view-label">Received By :</span>
                                    <span>{{ auth()->user()->full_name }}</span>
                                </div>
                                <div>
                                    <span class="money-receipt-view-label">Authorised By :</span>
                                    <span>WebCoder-it</span>
                                </div>
                            </div>
                        </div>
                        <div class="website-link-outer">
                            <a href="https://webcoder-it.com" target="_blank">
                                <i class="fa fa-chrome"></i>
                                https://webcoder-it.com ,
                            </a>
                            <a href="tel:01810139951">
                                <i class="fa fa-phone"></i> 01810139951-8
                            </a>
                        </div>                        
                    </div>
                    <!-- <a href="{{ url('/money/receipt/download/'.$moneyReceiptView->id) }}" class="money-receipt-download-btn pull-right mt-3">
                        <i class="fa fa-cloud-download"></i>
                        Print
                    </a> -->
                    <div class="money-receipt-print-btn-wrap pb-5 mt-5">
                        <div class="btn btn-success money-receipt-print-btn">Print</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $('.money-receipt-print-btn').click(function(){
            window.print();
        })
    </script>
</body>
</html>

