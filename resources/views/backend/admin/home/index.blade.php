@extends('backend.admin.admin-master')

@section('title')

@endsection

@section('content')
<div class="page-content">
    <div class="">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5 row-cols-xxl-5">
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body text-center">
                       <p class="mb-1">Today attendance</p>
                       <h3 class="mb-3">
                           {{ count(\App\Models\AttendanceLog::whereDate('created_at', \Carbon\Carbon::today())->get()) }}
                       </h3>
                       <div id="chart1"></div>
                    </div>
                </div>
            </div>
            <div class="col">
               <div class="card radius-10">
                   <div class="card-body text-center">
                      <p class="mb-1">Total Employee</p>
                      <h3 class="mb-3">{{ count(\App\Models\User::get()) }}</h3>
                      <div id="chart2"></div>
                   </div>
               </div>
           </div>
           <div class="col">
               <div class="card radius-10">
                   <div class="card-body text-center">
                      <p class="mb-1">Today Admission</p>
                      <h3 class="mb-3">{{ count(\App\Models\MoneyReceipt::whereDate('admission_date', \Carbon\Carbon::today())->get()) }}</h3>
                      <div id="chart3"></div>
                   </div>
               </div>
           </div>
           <div class="col">
               <div class="card radius-10">
                   <div class="card-body text-center">
                      <p class="mb-1">Today pending</p>
                      <h3 class="mb-3">{{ count(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())->where('status', 0)->get()) }}</h3>
                      <div id="chart4"></div>
                   </div>
               </div>
           </div>
           <div class="col col-md-12">
               <div class="card radius-10">
                   <div class="card-body text-center">
                      <p class="mb-1">Today Total Task Assign</p>
                      <h3 class="mb-3">{{ count(\App\Models\Task::whereDate('created_at', \Carbon\Carbon::today())->get()) }}</h3>
                      <div id="chart5"></div>
                   </div>
               </div>
           </div>
        </div><!--end row-->
        <!--Admission debit and credit calculation-->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5 row-cols-xxl-5">
            <a href="{{ url('/admin/user/today/admission/advance/info') }}">
                <div class="col">
                    <div class="card radius-10" style="background-color: #0bb2d3">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Today Admission Advance</p>
                            <h3 class="mb-3 text-white">
                                {{ number_format($todayCredit,2 ?? 0) }} Tk.
                            </h3>
                            <div id="chart1"></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ url('/admin/user/today/admission/due/info') }}">
                <div class="col">
                    <div class="card radius-10" style="background-color: darkred">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Today Admission Due</p>
                            <h3 class="mb-3 text-white">{{ number_format($todayDue,2 ?? 0) }} Tk.</h3>
                            <div id="chart4"></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ url('/admin/user/today/due/collect/info') }}">
                <div class="col col-md-12">
                    <div class="card radius-10" style="background-color: orangered">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Today Due Collection</p>
                            <h3 class="mb-3 text-white">{{ \App\Models\MoneyReceipt::with('admissionForm')->whereDate('updated_at', \Carbon\Carbon::today())->where('is_pay', 1)->get()->sum('today_pay') }} Tk.</h3>
                            <div id="chart5"></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ url('/admin/user/today/total/expanse/info') }}">
                <div class="col">
                    <div class="card radius-10" style="background-color: rebeccapurple">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Today Total Expanse</p>
                            <h3 class="mb-3 text-white">{{ number_format(\App\Models\Expance::whereDate('created_at', \Carbon\Carbon::today())->get()->sum('price'),2) }} Tk.</h3>
                            <div id="chart3"></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ url('/admin/user/monthly/admission/advance/info') }}">
                <div class="col">
                    <div class="card radius-10" style="background-color: deepskyblue">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Monthly Admission Advance</p>
                            <h3 class="mb-3 text-white">{{ number_format($monthlyCredit,2 ?? 0) }} Tk.</h3>
                            <div id="chart2"></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ url('/admin/user/monthly/admission/due/info') }}">
            <div class="col">
                <div class="card radius-10" style="background-color: rebeccapurple">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Admission Due</p>
                        <h3 class="mb-3 text-white">{{ number_format($monthlyDebit,2 ?? 0) }} Tk.</h3>
                        <div id="chart3"></div>
                    </div>
                </div>
            </div>
            </a>
            <a href="{{ url('/admin/user/monthly/due/collect/info') }}">
                <div class="col">
                    <div class="card radius-10" style="background-color: rebeccapurple">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Monthly Due Collection</p>
                            <h3 class="mb-3 text-white">{{ \App\Models\MoneyReceipt::whereMonth('updated_at', date('m'))->where('is_pay', 1)->get()->sum('today_pay') }} Tk.</h3>
                            <div id="chart3"></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ url('/admin/user/monthly/total/expanse/info') }}">
                <div class="col">
                    <div class="card radius-10" style="background-color: orangered">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Monthly Total Expanse</p>
                            <h3 class="mb-3 text-white">{{ number_format(\App\Models\Expance::whereMonth('created_at', date('m'))->get()->sum('price'),2) }} Tk.</h3>
                            <div id="chart5"></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ url('/admin/user/total/due/info') }}">
                <div class="col col-md-12">
                    <div class="card radius-10" style="background-color: orangered">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Total Due</p>
                            <h3 class="mb-3 text-white">{{ number_format($totalDue,2 ?? 0) }} Tk.</h3>
                            <div id="chart5"></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ url('/admin/user/total/collect/due/info') }}">
            <div class="col col-md-12">
                <div class="card radius-10" style="background-color: orangered">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Total Due Collection</p>
                        <h3 class="mb-3 text-white">{{ number_format(\App\Models\MoneyReceipt::get()->sum('today_pay'),2) ?? 0 }} Tk.</h3>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
            </a>
            <a href="{{ url('/admin/user/total/admission/advance/info') }}">
            <div class="col col-md-12">
                <div class="card radius-10" style="background-color: orangered">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Total Admission Advance</p>
                        <h3 class="mb-3 text-white">{{ number_format(\App\Models\MoneyReceipt::get()->sum('advance'),2) ?? 0 }} Tk.</h3>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
            </a>
            <a href="{{ url('/admin/user/total/expanse/info') }}">
            <div class="col col-md-12">
                <div class="card radius-10" style="background-color: orangered">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Total Expanse</p>
                        <h3 class="mb-3 text-white">{{ number_format(\App\Models\Expance::get()->sum('price'),2) ?? 0 }} Tk.</h3>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
            </a>
            <a href="{{ url('/admin/user/total/adm/admission/info') }}">
            <div class="col">
                <div class="card radius-10" style="background-color: #CD5C5C">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly ADM Admission</p>
                        <h3 class="mb-3 text-white">{{ count($admissionData['monthlyAdmAdmission']) }}</h3>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            </a>
            <a href="{{ url('/admin/user/total/web/admission/info') }}">
            <div class="col">
                <div class="card radius-10" style="background-color: #6495ED">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Web Admission</p>
                        <h3 class="mb-3 text-white">{{ count($admissionData['monthlyWebAdmission']) }}</h3>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            </a>
            <a href="{{ url('/admin/user/total/eng/admission/info') }}">
            <div class="col col-md-12">
                <div class="card radius-10" style="background-color: #800080">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly English Admission</p>
                        <h3 class="mb-3 text-white">{{ count($admissionData['monthlyEngAdmission']) }}</h3>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            </a>
            <a href="{{ url('/admin/user/total/monthly/admission/info') }}">
            <div class="col col-md-12">
                <div class="card radius-10" style="background-color: #641111">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Total Monthly Admission</p>
                        <h3 class="mb-3 text-white">{{ \App\Models\MoneyReceipt::whereMonth('created_at', date('m'))->count() }}</h3>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <div class="card radius-10 p-4">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ url('/admin/dashboard') }}" method="get" class="form-group mb-5">
                        @csrf
                        <div class="row">
                            <div class="col-md-7">
                                <label style="font-weight: 600;margin-bottom: 5px;">
                                    View Admission
                                </label><br>
                                <select name="admission_filtering" id="admission_filtering" class="form-control">
                                    <option selected disabled>--- View Admission ---</option>
                                    <option value="{{ date('Y-m-d', strtotime(\Carbon\Carbon::yesterday())) }}">Yesterday</option>
                                    <option value="{{ date('Y-m-d', strtotime(\Carbon\Carbon::now()->subDays(7))) }}">Last 7 Days</option>
                                    <option value="{{ date('Y-m-d', strtotime(\Carbon\Carbon::now()->subDays(15))) }}">Last 15 Days</option>
                                    <option value="{{ date('Y-m-d', strtotime(\Carbon\Carbon::now()->subDays(30))) }}">Last 30 Days</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group" style="margin-top: 25px;">
                                    <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
                                    <a href="{{ url('/admin/dashboard') }}" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card radius-10" style="background-color: rebeccapurple">
                                <div class="card-body text-center">
                                    <p class="mb-1 text-white">Total Admission</p>
                                    <h3 class="mb-3 text-white">
                                        @if(count($filterAdmission['admissionDayCount']) > 0)
                                            {{ count($filterAdmission['admissionDayCount']) }}
                                        @else
                                            0
                                        @endif
                                    </h3>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card radius-10" style="background-color: rebeccapurple">
                                <div class="card-body text-center">
                                    <p class="mb-1 text-white">Total Advance</p>
                                    <h3 class="mb-3 text-white">
                                        @if(count($filterAdmission['admissionDayCount']) > 0)
                                            {{ $filterAdmission['admissionDayCount'] ? number_format($filterAdmission['admissionDayCount']->sum('advance'), 2) : '0' }}. Tk
                                        @else
                                            0
                                        @endif
                                    </h3>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card radius-10" style="background-color: rebeccapurple">
                                <div class="card-body text-center">
                                    <p class="mb-1 text-white">Total Due</p>
                                    <h3 class="mb-3 text-white">
                                        @if(count($filterAdmission['admissionDayCount']) > 0)
                                            {{ $filterAdmission['admissionDayCount'] ? number_format($filterAdmission['admissionDayCount']->sum('due'), 2) : '0' }}. Tk
                                        @else
                                            0
                                        @endif
                                    </h3>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <form action="{{ url('/admin/dashboard') }}" method="get" class="form-group mb-5">
                        <div class="row">
                            <div class="col-md-7">
                                <label style="font-weight: 600;margin-bottom: 5px;">
                                    View Expanse
                                </label><br>
                                <select name="expanse_filtering" id="" class="form-control">
                                    <option selected disabled>--- View Expanse ---</option>
                                    <option value="{{ date('Y-m-d', strtotime(\Carbon\Carbon::yesterday())) }}">Yesterday</option>
                                    <option value="{{ date('Y-m-d', strtotime(\Carbon\Carbon::now()->subDays(7))) }}">Last 7 Days</option>
                                    <option value="{{ date('Y-m-d', strtotime(\Carbon\Carbon::now()->subDays(15))) }}">Last 15 Days</option>
                                    <option value="{{ date('Y-m-d', strtotime(\Carbon\Carbon::now()->subDays(30))) }}">Last 30 Days</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group" style="margin-top: 25px;">
                                    <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
                                    <a href="{{ url('/admin/dashboard') }}" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card radius-10" style="background-color: deepskyblue">
                                <div class="card-body text-center">
                                    <p class="mb-1 text-white">Total Expanse</p>
                                    <h3 class="mb-3 text-white">
                                        @if(count($filterExpanse['expanse']) > 0)
                                            {{ number_format($filterExpanse['expanse']->sum('price'), 2) }}. Tk
                                        @else
                                            0
                                        @endif
                                    </h3>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wrapper">
    <div class="page-wrapper" style="margin-left: 20px!important;">
        <canvas id="myChart" height="100px"></canvas>
    </div>
</div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script type="text/javascript">

        var labels =  {{ \Illuminate\Support\Js::from($labels) }};
        var users =  {{ \Illuminate\Support\Js::from($data) }};

        const data = {
            labels: labels,
            datasets: [{
                label: 'Admissions',
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1,
                data: users,
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

    </script>
{{--    <script>--}}
{{--        setInterval(function() {--}}
{{--            window.location.reload();--}}
{{--        }, 10000);--}}
{{--    </script>--}}
@endpush
