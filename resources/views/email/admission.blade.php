<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Money Receipt From Webcoder-IT Institute</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{ asset('backend/') }}/assets/images/favicon-32x32.png" type="image/png" />
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
    <h2>{{ $admissions->s_name }} অভিনন্দন আপনার ভর্তি সফল হয়েছে</h2>
    <hr/>
    <h3>কোর্স ফি বকেয়া পেমেন্ট</h3>
    <p>
        আপনার মোট কোর্স ফি মোট {{ $admissions->moneyReceipt->total_fee }} টাকা, আপনি দিয়েছেন {{ $admissions->moneyReceipt->advance }} টাকা, বাকি থাকলো {{ $admissions->moneyReceipt->due }} টাকা, এই বাকী পেমেন্ট আপনাকে অবশ্যই ক্লাস শুরু হওয়ার ১মাসের মধ্যেই দিয়ে দিতে হবে। এবং এডমিন কে জানাতে হবে যে আপনি পেমেন্ট পরিশোধ করেছেন। আর যদি পেমেন্ট পরিশোধ না করেন তাহলে আপনাকে গ্রুপ থেকে রিমুভ করে দেয়া হবে। <br/>
        বিকাশ মার্চেন্টঃ ০১৮১২২৩৪৪৮৯ <br/>
        নগদ /রকেটঃ ০১৩০৩৩২৬১২৩ <br/>
        বিকাশ পার্সোনালঃ ০১৩০৩৩২৬১২৩ (রিপন)
    </p>
    <h3>কোর্স চলাকালীন সাপোর্টের শর্ত সম্মূহঃ</h3>
    <p>
        কোর্স ফি সম্পূর্ন পরিশোধ করতে হবে।
        নিয়মিত ক্লাসে অংশগ্রহন করতে হবে।
        সকল ক্লাসের এসাইনমেন্ট যথাযথ সময়ে প্রদান করতে হবে।
        পরীক্ষায় অংশগ্রহন ও পাস করতে হবে।
        মার্কেট প্লেসে একাউন্ট করার পরে শিক্ষকের নির্দেশ মেনে কাজ করতে হবে।
    </p>
    <h3>কোর্স শেষ হওয়ার পর সাপোর্ট এর শর্ত সম্মূহঃ</h3>
    <p>
        আমাদের সাথে যোগাযোগ রাখতে হবে।
        ফেসবুক অফিসিয়াল গ্রুপে নিয়মিত পোষ্ট কমেন্ট করে এক্টিভ থাকতে হবে।
        কাজ পাওয়ার পর ফেসবুক অফিসিয়াল গ্রুপে পোষ্ট করতে হবে।
    </p>
    <h3>যে কাজগুলো করলে সাপোর্ট বাতিল করা হবেঃ</h3>
    <p>
        প্রতিষ্ঠানের সাথে যোগাযোগ না রাখলে।
        প্রতিষ্ঠানের বিরুদ্ধে মিথ্যাচার করলে।
        কোন শিক্ষক কিংবা শিক্ষার্থীর সাথে দূর্ব্যবহার করলে।
        নিয়মিত কাজ পাওয়ার পর ফেসবুক অফিসিয়াল গ্রুপে নিয়মিত পোষ্ট না করলে ।
        নোট : ক্লাস চলাকালীন অবশ্যই স্টুডেন্টকে নিয়মিত ক্লাস এবং এসাইনমেন্ট না দিলে সে সাপোর্ট থেকে বঞ্চিত হবে,আমরা ১ বছর সাপোর্ট প্রদান করে থাকি এর সাপোর্ট পেতে হলে স্টুডেন্ট এর আচার ব্যাবহার এর উপরে ডিপেন্ড করবে.
    </p>
    <p>
        কোন শিক্ষার্থী যদি ভর্তি হওয়ার পর ক্লাস শুরুর পূর্বে উপযুক্ত কারনে ভর্তি বাতিল করতে চায় তবে বাতিল করতে পারবে। তবে অবশ্যই ভর্তি বাতিলের উপযুক্ত কারন দর্শাতে হবে এবং ভর্তি বাতিল বাবদ ৫০% কোর্স ফি কর্তন করা হবে আর বাকি ৫০% ফি ছাত্র/ছাত্রী ফেরত পাবে। আর ক্লাস শুরুর পর যদি কোন শিক্ষার্থী ভর্তি বাতিল করতে চায় তবে তার ভর্তি হওয়ার সময় প্রদানকৃত অর্থ ফেরত অযোগ্য বলে গণ্য হবে।
    </p>

    <section class="money-receipt-view mt-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8 m-auto">
                    <div class="money-receipt-view-wrapper">
                        <div class="institute-address-wrapper">
                            <div class="institute-logo-wrapper">
                                <img src="{{ asset('backend/') }}/assets/logo6.png" class="institute-logo">
                            </div>
                            <div class="address-title-outer">
                                <h4 class="address-title">Money Receipt</h4>
                            </div>
                            <div class="institute-address-outer">
                                <p class="address-inner" style="font-weight: 700;">
                                    <i class="fas fa-home"></i>
                                    House#06, Level#03 Road-1/A, Sector#09 Housebuilding, Uttara Dhaka-1230, 01810139951-8
                                </p>
                                <a href="https://webcoder-it.com/" class="website-link">
                                    <i class="fas fa-globe"></i>
                                    webcoder-it.com
                                </a>
                            </div>
                        </div>
                        <div class="money-receipt-info-wrapper">
                            <div class="money-receipt-info-item">
                                <div class="stu-id">
                                    <span class="admission-form-view-label">Student ID :</span>
{{--                                    <span>{{ ucfirst($admissions->course) ?? '' }} - {{ $admissions->student_id ?? '' }}</span>--}}
                                </div>
                                <div class="admission-date">
                                    <span class="money-receipt-view-label">Admission Date :</span>
{{--                                    <span>{{ $admissions->moneyReceipt->admission_date->format('Y-m-d') ?? ' ' }}</span>--}}
                                </div>
                            </div>
                            <div class="money-receipt-info-item">
                                <div>
                                    <span class="money-receipt-view-label">Student Name :</span>
{{--                                    <span>{{ $admissions->s_name ?? ' ' }}</span>--}}
                                </div>
                                <div>
                                    <span class="money-receipt-view-label">Phone :</span>
{{--                                    <span>{{ $admissions->s_phone ?? ' ' }}</span>--}}
                                </div>
                            </div>
                            <div class="money-receipt-info-item">
                                <div>
                                    <span class="money-receipt-view-label">
                                        Course Name :
                                    </span>
{{--                                    <span>--}}
{{--                                        @if($admissions->course == 'web')--}}
{{--                                            Full stack web development--}}
{{--                                        @elseif($admissions->course == 'digital')--}}
{{--                                            Advanced Digital Marketing--}}
{{--                                        @else--}}
{{--                                            Communication English--}}
{{--                                        @endif--}}
{{--                                    </span>--}}
                                </div>
                                <div>
                                    <span class="money-receipt-view-label">Batch No :</span>
{{--                                    <span>{{ $admissions->batch_no }}</span>--}}
                                </div>
                            </div>
                            <div class="money-receipt-info-item">
                                <div>
                                    <span class="money-receipt-view-label">Total Fee :</span>
{{--                                    <span>{{ $admissions->moneyReceipt->total_fee }} TK </span>--}}
                                </div>
                                <div>
                                    <span class="money-receipt-view-label">Due :</span>
{{--                                    <span>--}}
{{--                                        @if($admissions->moneyReceipt->due == 0)--}}
{{--                                            Paid--}}
{{--                                        @else--}}
{{--                                            {{ $admissions->moneyReceipt->due }} TK--}}
{{--                                        @endif--}}
{{--                                    </span>--}}
                                </div>
                            </div>

                            <div class="money-receipt-info-item">
                                <div>
                                    <span class="money-receipt-view-label">First Payment :</span>
{{--                                    <span>{{ $admissions->moneyReceipt->advance }} TK. <small style="color: red">( With Cost )</small> </span>--}}
                                </div>
{{--                                <div>--}}
{{--                                    @if($admissions->moneyReceipt->today_pay != null)--}}
{{--                                        <span class="money-receipt-view-label">Second Payment :</span>--}}
{{--                                        <span>{{ $admissions->moneyReceipt->today_pay ?? "Not Yet" }} TK. <small style="color: red">( With Cost )</small> </span>--}}
{{--                                    @else--}}

{{--                                    @endif--}}
{{--                                </div>--}}
                            </div>
                            <div class="money-receipt-info-item">
                                <div>
                                    <span class="money-receipt-view-label">Received By :</span>
{{--                                    <span>{{ auth()->user()->full_name }}</span>--}}
                                </div>
                                <div>
                                    <span class="money-receipt-view-label">Authorised By :</span>
                                    <span>Webcoder-IT</span>
                                </div>
                            </div>
                        </div>
                        <div class="website-link-outer">
                            <p style="color: #f16522;margin-bottom: 0;">
                                <b>One Time Learning & Lifetime Earning.</b>
                            </p>
                        </div>
                    </div>
{{--                <!-- <a href="{{ url('/money/receipt/download/'.$moneyReceiptView->id) }}" class="money-receipt-download-btn pull-right mt-3">--}}
{{--                        <i class="fa fa-cloud-download"></i>--}}
{{--                        Print--}}
{{--                    </a> -->--}}
                    <div class="money-receipt-print-btn-wrap pb-5 mt-3">
                        <div class="money-receipt-download-btn" style="cursor: pointer;">Print</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
