@extends('backend.admin.master')

@section("content")
<section style="padding: 40px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="money-receipt-view-wrapper" style="box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;">
                    <div style="display: flex;align-items: center;justify-content: space-between;">
                        <div style="width: calc(100% - 210px);text-align: center;">
                            <h4 style="background: #f16522;display: inline-block;padding: 5px 20px;font-size: 20px;font-weight: 500;color: #fff;border-radius: 0px 10px;margin-bottom: 0;margin-top: 20px;margin-left: 80px;">
                                Money Receipt
                            </h4>
                        </div>
                        <div style="width: 210px;">
                            <img src="{{ asset('backend/') }}/assets/logo3.png" class="institute-logo">
                            <p style="font-weight: 500;margin-bottom: 0;font-size: 13px;">
                                House#06, Level#03 Road-1/A, Sector#09 Housebuilding, Uttara Dhaka-1230
                            </p>
                        </div>
                    </div>
                    <div class="money-receipt-info-wrapper" style="hover:background: #ddd">
                        <div style="display: flex;align-items: center;justify-content: space-between;padding: 5px 50px;border-bottom: 1px solid #ddd;margin-bottom: 6px;">
                            <div class="stu-id">
                                <span style="font-size: 15px;color: #000;font-weight: 500;">
                                    Student ID :
                                </span>
                                <span style="color: #000;"></span>
                            </div>
                            <div class="admission-date">
                                <span style="font-size: 15px;color: #000;font-weight: 500;">
                                Admission Date :</span>
                                <span style="color: #000;"></span>
                            </div>
                        </div>
                        <div style="display: flex;align-items: center;justify-content: space-between;padding: 5px 50px;border-bottom: 1px solid #ddd;margin-bottom: 6px;">
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">
                                Student Name :</span>
                                <span style="color: #000;"></span>
                            </div>
                        </div>
                        <div style="display: flex;align-items: center;justify-content: space-between;padding: 5px 50px;border-bottom: 1px solid #ddd;margin-bottom: 6px;">
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">
                                Course Name :</span>
                                <span style="color: #000;"></span>
                            </div>
                        </div>
                        <div style="display: flex;align-items: center;justify-content: space-between;padding: 5px 50px;border-bottom: 1px solid #ddd;margin-bottom: 6px;">
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">
                                Total Fee :</span>
                                <span style="color: #000;">TK</span>
                            </div>
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">
                                Advance :</span>
                                <span style="color: #000;">TK</span>
                            </div>
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">
                                Due :</span>
                                <span style="color: #000;">TK</span>
                            </div>
                        </div>
                        <div style="display: flex;align-items: center;justify-content: space-between;padding: 5px 50px;border-bottom: 1px solid #ddd;margin-bottom: 6px;">
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">
                                Received By :</span>
                                <span style="color: #000;"></span>
                            </div>
                            <div>
                                <span style="font-size: 15px;color: #000;font-weight: 500;">
                                Authorised By :</span>
                                <span>WebCoder-it</span>
                            </div>
                        </div>
                    </div>
                    <div style="text-align: center; padding-top: 10px;padding-bottom: 20px;">
                        <a href="https://webcoder-it.com" target="_blank" style="color: #f16522;display: inline-block;font-size: 16px;">
                            https://webcoder-it.com ,
                        </a>
                        <a href="tel:01814812233" style="color: #f16522;display: inline-block;font-size: 16px;">
                            01810139951-8
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
