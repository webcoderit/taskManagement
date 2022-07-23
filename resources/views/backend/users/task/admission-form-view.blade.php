@extends('backend.admin.master')

@section('content')
<section class="student-addmission-form-section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="addmission-form-wrapper view">
                    <div class="addmission-form-heading-view">
                        <div style="width: 360px;">
                            <h2 class="institute-name">Web<span>coder</span>-it</h2>
                            <address>
                                House#06, Level#03 Road-1/A, Sector#09 Housebuilding, Uttara Dhaka-1230
                            </address>
                            <span>
                                <a href="tel:01648177071">
                                    <i class="fa fa-phone" style="color: #f16522;"></i>
                                    01648177071 ,
                                </a>
                            </span>
                            <span>
                                <a href="tel:01814812233">
                                    <i class="fa fa-phone" style="color: #f16522;"></i>
                                    01814812233
                                </a>
                            </span><br>
                            <span>
                                <a href="https://webcoder-it.com/" target="_blank" title="Website">
                                    <i class="fa fa-chrome" style="color: #f16522;"></i>
                                    www.webcoder-it.com ,
                                </a>
                            </span>
                            <span>
                                <a href="mailto:webcoderit@gmail.com" title="Gmail Id">
                                    <i class="fa fa-envelope" style="color: #f16522;"></i>
                                    webcoderit@gmail.com
                                </a>
                            </span>
                        </div>
                        @if($admissionForm->avatar != null)
                            <div>
                                <img src="{{ asset('/student/'.$admissionForm->avatar) }}" style="height: 130px; width: 150px; margin-bottom: 10px;">
                            </div>
                        @endif
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
                                <span class="admission-form-view-label">Educational Qualification : </span>
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
                                <span class="admission-form-view-label">Course Name : </span>
                                <span class="admission-form-view-value">
                                    @if($admissionForm->course == 'web')
                                        Full stack web development
                                    @elseif($admissionForm->course == 'digital')
                                        Advance digital marketing
                                    @else
                                        Communication English
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
                                <span class="admission-form-view-label">Total Fee : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->moneyReceipt->total_fee ?? '' }} Tk.</span>
                            </div>
                            <div>
                                <span class="admission-form-view-label">Advance : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->moneyReceipt->advance ?? '' }} Tk.</span>
                            </div>
                            <div>
                                <span class="admission-form-view-label">Due : </span>
                                <span class="admission-form-view-value">{{ $admissionForm->moneyReceipt->due ?? '' }} Tk.</span>
                            </div>
                        </div>
                        <div class="admission-form-view-item">
                            <span class="admission-form-view-label">In Word : </span>
                            <span class="admission-form-view-value"></span>
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
                                <span class="">Webcoder-it</span>
                            </div>
                        </div>
                        <div class="institute-service-note">
                            <p>
                                We Build Any Kinds of Website and We Provide Complete Digital Marketing Solution for your Company.
                            </p>
                        </div>
                        <a href="{{ url('/admission/form/download/'.$admissionForm->id) }}" class="admission-form-download-btn pull-right">
                            <i class="fa fa-cloud-download"></i>
                                Download
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
