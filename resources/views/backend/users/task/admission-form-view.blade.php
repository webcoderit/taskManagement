<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admission form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('backend/') }}/assets/css/style.css" />

    <style>
        .admission-form-logo p {
            font-weight: 700;
            color: #f16522;
            margin-bottom: 0;
        }
        .admission-title-outer {
            text-align: center;
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
        }
         @media print {
            *{
                visibility: hidden;
            }
            .addmission-form-wrapper,
            .addmission-form-wrapper *{
                visibility: visible;
            }
        } 
    </style>
</head>
<body>
<section class="student-addmission-view mt-3">    
    <div class="container">
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="money-receipt-print-btn-wrap pb-3">
                    <div class="money-receipt-download-btn" style="cursor: pointer;">Print</div>
                </div>
                <div class="addmission-form-wrapper view">
                    <div class="addmission-form-heading-view">
                        <div class="admission-form-logo">
                            <img src="{{ asset('backend/') }}/assets/logo6.png" class="institute-logo">
                            <p>
                                One Time Learning & Lifetime Earning.
                            </p>
                        </div>                        
                        @if($admissionForm->avatar != null)
                            <div>
                                <img src="{{ asset('/student/'.$admissionForm->avatar) }}" style="height: 130px; width: 150px;">
                            </div>
                        @endif                        
                    </div>
                    <div class="admission-title-outer">
                        <h4 class="address-title">Admission Form</h4>
                    </div>
                    <div class="admission-form-view">
                        <div class="admission-form-view-item">
                            <div>
                                <span class="admission-form-view-label">Student Name : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->s_name }}</span>
                            </div>
                            <div>
                                <span class="admission-form-view-label">Student Email : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->s_email }}</span>
                            </div>
                        </div>
                        <div class="admission-form-view-item">
                            <div>
                                <span class="admission-form-view-label">Father Name : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->f_name }}</span>
                            </div>
                            <div>
                                <span class="admission-form-view-label">Mother Name : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->m_name }}</span>
                            </div>
                        </div>
                        <div class="admission-form-view-item">
                            <div>
                                <span class="admission-form-view-label">Student Phone No. : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->s_phone }}</span>
                            </div>
                            <div>
                                <span class="admission-form-view-label">Father Phone No. : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->f_phone }}</span>
                            </div>
                        </div>
                        <div class="admission-form-view-item">
                            <div>
                                <span class="admission-form-view-label">Date Of Birth : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->dob }}</span>
                            </div>
                            <div>
                                <span class="admission-form-view-label">Profession : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->profession }}</span>
                            </div>
                            <div>
                                <span class="admission-form-view-label">Gender : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->gender }}</span>
                            </div>
                        </div>
                        <div class="admission-form-view-item">
                            <div>
                                <span class="admission-form-view-label">Blood Group : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->blood_group }}</span>
                            </div>
                            <div>
                                <span class="admission-form-view-label">Qualification : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->qualification }}</span>
                            </div>
                            <div>
                                <span class="admission-form-view-label">NID No. : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->nid }}</span>
                            </div>
                        </div>
                        <div class="admission-form-view-item">
                            <div>
                                <span class="admission-form-view-label">FB Name/Link : </span>
                                <a href="https://www.facebook.com/saidulislamjihad20" target="_blank" class="admission-form-view-value">
                                    {{ $admissionForm->fb_id }}
                                </a>
                            </div>
                            <div>
                                <span class="admission-form-view-label">Student Ref. Name : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->reference }}</span>
                            </div>
                        </div>
                        <div class="admission-form-view-item">
                            <div>
                                <span class="admission-form-view-label">Address : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->present_address }}</span>
                            </div>
                        </div>
                        <div class="admission-form-view-item">
                            <div>
                                <span class="admission-form-view-label">Other Way Admission Note : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->other_admission_note }}</span>
                            </div>
                        </div>
                        <div class="admission-form-view-item">
                            <div>
                                <span class="admission-form-view-label">Course Name : </span>
                                <span class="admission-form-view-value">
                                    @if($admissionForm->course == 'web')
                                        WEB
                                    @elseif($admissionForm->course == 'digital')
                                        ADM
                                    @else
                                        ENG
                                    @endif
                                </span>
                            </div>
                            <div>
                                <span class="admission-form-view-label">Batch No. : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->batch_no }}</span>
                            </div>
                            <div>
                                <span class="admission-form-view-label">Batch Type : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->batch_type }}</span>
                            </div>
                        </div>
                        <div class="admission-form-view-item">
                            <div>
                                <span class="admission-form-view-label">Payment Type : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->moneyReceipt->payment_type ?? '' }}</span>
                            </div>
                            <div>
                                <span class="admission-form-view-label">Admission Date : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->moneyReceipt->admission_date ?? '' }}</span>
                            </div>
                        </div>
                        <div class="admission-form-view-item">                            
                            <div>
                                <span class="admission-form-view-label">Transaction ID : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->moneyReceipt->transaction_id }}</span>
                            </div>
                        </div>
                        <div class="admission-form-view-item">
                            <div>
                                <span class="admission-form-view-label">Total Fee : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->moneyReceipt->total_fee ?? '' }} Tk.</span>
                            </div>
                            <div>
                                <span class="admission-form-view-label">Due : </span>
                                @if($admissionForm->moneyReceipt->due == 0)
                                    Paid
                                @else
                                    <span class="admission-form-view-value">{{ $admissionForm->moneyReceipt->due ?? 'Paid' }} Tk.</span>
                                @endif
                                
                            </div>
                        </div>
                        <div class="admission-form-view-item">
                            <div>
                                <span class="admission-form-view-label">First Payment : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->moneyReceipt->advance ?? '' }} Tk.</span>
                            </div>
                            <div>
                                <span class="admission-form-view-label">Second Payment : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->moneyReceipt->today_pay ?? '' }} Tk.</span>
                            </div>
                        </div>
                        <div class="admission-form-view-item">
                            <div>
                                <span class="admission-form-view-label">Class Shedule : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->class_shedule }}</span>
                            </div>
                            <div>
                                <span class="admission-form-view-label">Class Time : </span>
                                <span class="">{{ $admissionForm->class_time }}</span>
                            </div>
                        </div>
                        <div class="institute-note">
                            <div>
                                <span class="admission-form-view-label">Note : </span>
                                <span class="admission-form-view-value">
                                    Incomplete Application will be Cancelled.
                                </span>
                            </div>
                            <div>
                                <span class="admission-form-view-label">Authorized By : </span>
                                <span class="">Webcoder-IT</span>
                            </div>
                        </div>
                        <!-- <div class="institute-service-note">
                            <p>
                                We Build Any Kinds of Website and We Provide Complete Digital Marketing Solution for your Company.
                            </p>
                        </div> -->
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $('.money-receipt-download-btn').click(function(){
            window.print();
        })
    </script>
</body>
</html>
