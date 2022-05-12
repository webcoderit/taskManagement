@extends('backend.admin.master')

@section('content')
<section style="padding: 40px 0px">
    <div class="container">
        <div class="row">
            <div class="col-md-10 m-auto">
                <div style="background-image: url({{ asset('backend/') }}/assets/logo4.png);background-position: center;background-repeat: no-repeat;background-size: contain;box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;padding: 20px;">
                    <div style="margin-bottom: 15px;border-bottom: 1px solid #ddd;display: flex;justify-content: space-between;">
                        <div style="width: 350px;">
                            <h2 style="font-size: 30px;text-transform: uppercase;color: #f16522;letter-spacing: 2px;margin-bottom: 0px;">
                                Web<span style="color: #564c4c;">coder</span>-it
                            </h2>
                            <address style="margin-bottom: 5px;">
                                House#06, Level#03 Road-1/A, Sector#09 Housebuilding, Uttara Dhaka-1230
                            </address>
                            <span>
                                <a href="tel:01648177071" style="display: inline-block;color: #000;font-size: 14px;">
                                    01648177071 ,
                                </a>
                            </span>
                            <span>
                                <a href="tel:01814812233" style="display: inline-block;color: #000;font-size: 14px;">
                                    01814812233
                                </a>
                            </span><br>
                            <span>
                                <a href="https://webcoder-it.com/" target="_blank" title="Website" style="display: inline-block;color: #000;font-size: 14px;">
                                    www.webcoder-it.com ,
                                </a>
                            </span>
                            <span>
                                <a href="mailto:webcoderit@gmail.com" title="Gmail Id" style="display: inline-block;color: #000;font-size: 14px;">
                                    webcoderit@gmail.com
                                </a>
                            </span>
                        </div>
                        <div>
                            <img src="{{ $admissionForm->avatar ?? 'image not found' }}" style="height: 130px; width: 150px; margin-bottom: 10px;">
                        </div>
                    </div>
                    <div>
                        <div style="display: flex;align-items: center;justify-content: space-between;border-bottom: 1px solid #ddd;margin-bottom: 10px;padding-bottom: 10px;">
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Student Name : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Student Email : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                        </div>
                        <div style="display: flex;align-items: center;justify-content: space-between;border-bottom: 1px solid #ddd;margin-bottom: 10px;padding-bottom: 10px;">
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Father Name : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Mother Name : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                        </div>
                        <div style="display: flex;align-items: center;justify-content: space-between;border-bottom: 1px solid #ddd;margin-bottom: 10px;padding-bottom: 10px;">
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Student Phone No. : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Father Phone No. : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                        </div>
                        <div style="display: flex;align-items: center;justify-content: space-between;border-bottom: 1px solid #ddd;margin-bottom: 10px;padding-bottom: 10px;">
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Date Of Birth : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Profession : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Gender : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                        </div>
                        <div style="display: flex;align-items: center;justify-content: space-between;border-bottom: 1px solid #ddd;margin-bottom: 10px;padding-bottom: 10px;">
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Blood Group : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Educational Qualification : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">NID No. : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                        </div>
                        <div style="display: flex;align-items: center;justify-content: space-between;border-bottom: 1px solid #ddd;margin-bottom: 10px;padding-bottom: 10px;">
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Address : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                        </div>
                        <div style="display: flex;align-items: center;justify-content: space-between;border-bottom: 1px solid #ddd;margin-bottom: 10px;padding-bottom: 10px;">
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Course Name : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Batch No. : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Batch Type : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                        </div>
                        <div style="display: flex;align-items: center;justify-content: space-between;border-bottom: 1px solid #ddd;margin-bottom: 10px;padding-bottom: 10px;">
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Payment Type : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Admission Date : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                        </div>
                        <div style="display: flex;align-items: center;justify-content: space-between;border-bottom: 1px solid #ddd;margin-bottom: 10px;padding-bottom: 10px;">
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Total Fee : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Advance : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Due : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                        </div>
                        <div style="display: flex;align-items: center;justify-content: space-between;border-bottom: 1px solid #ddd;margin-bottom: 10px;padding-bottom: 10px;">
                            <span style="    -size: 15px;
   r: #000;
   -weight: 500;">In Word : </span>
                            <span style="    -size: 14px;
   r: #000;"></span>
                        </div>
                        <div style="display: flex;align-items: center;justify-content: space-between;border-bottom: 1px solid #ddd;margin-bottom: 10px;padding-bottom: 10px;">
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Class Shedule : </span>
                                <span style="font-size: 14px;color: #000;"></span>
                            </div>
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">Class Time : </span>
                                <span class=""></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
