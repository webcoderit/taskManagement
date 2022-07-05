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
            <div class="col">
                <div class="card radius-10" style="background-color: darkred">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Today Admission Due</p>
                        <h3 class="mb-3 text-white">{{ number_format($todayDue,2 ?? 0) }} Tk.</h3>
                        <div id="chart4"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: deepskyblue">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Admission Advance</p>
                        <h3 class="mb-3 text-white">{{ number_format($monthlyCredit,2 ?? 0) }} Tk.</h3>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: rebeccapurple">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Admission Due</p>
                        <h3 class="mb-3 text-white">{{ number_format($monthlyDebit,2 ?? 0) }} Tk.</h3>
                        <div id="chart3"></div>
                    </div>
                </div>
            </div>
            <div class="col col-md-12">
                <div class="card radius-10" style="background-color: orangered">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Total Due</p>
                        <h3 class="mb-3 text-white">{{ number_format($totalDue,2 ?? 0) }} Tk.</h3>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: rebeccapurple">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Due Collection</p>
                        <h3 class="mb-3 text-white">{{ \App\Models\MoneyReceipt::whereMonth('updated_at', date('m'))->get()->sum('today_pay') }} Tk.</h3>
                        <div id="chart3"></div>
                    </div>
                </div>
            </div>
            <div class="col col-md-12">
                <div class="card radius-10" style="background-color: orangered">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Total Due Collection</p>
                        <h3 class="mb-3 text-white">{{ \App\Models\MoneyReceipt::whereDate('updated_at', \Carbon\Carbon::today())->get()->sum('today_pay') }} Tk.</h3>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: rebeccapurple">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Today Total Expanse</p>
                        <h3 class="mb-3 text-white">{{ number_format(\App\Models\Expance::whereDate('created_at', \Carbon\Carbon::today())->get()->sum('price'),2) }} Tk.</h3>
                        <div id="chart3"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: orangered">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Total Expanse</p>
                        <h3 class="mb-3 text-white">{{ number_format(\App\Models\Expance::whereMonth('created_at', date('m'))->get()->sum('price'),2) }} Tk.</h3>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
            <div class="col col-md-12">
                <div class="card radius-10" style="background-color: #641111">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Total Monthly Admission</p>
                        <h3 class="mb-3 text-white">{{ \App\Models\AdmissionForm::whereMonth('created_at', date('m'))->count() }}</h3>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
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
                                    <option value="{{ \Carbon\Carbon::today() }}">Today</option>
                                    <option value="{{ \Carbon\Carbon::yesterday() }}">Yesterday</option>
                                    <option value="{{ \Carbon\Carbon::now()->subDays(7) }}">Last 7 Days</option>
                                    <option value="{{ \Carbon\Carbon::now()->subDays(15) }}">Last 15 Days</option>
                                    <option value="{{ \Carbon\Carbon::now()->subDays(30) }}">Last 30 Days</option>
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
                                        @if(count($filterAdmission['today']) > 0)
                                            {{ count($filterAdmission['today']) }}
                                        @elseif(count($filterAdmission['yesterday']) > 0)
                                            {{ count($filterAdmission['yesterday']) }}
                                        @elseif(count($filterAdmission['last7Days']) > 0)
                                            {{ count($filterAdmission['last7Days']) }}
                                        @elseif(count($filterAdmission['last15Days']) > 0)
                                            {{ count($filterAdmission['last15Days']) }}
                                        @elseif(count($filterAdmission['last30Days']) > 0)
                                            {{ count($filterAdmission['last30Days']) }}
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
                                        @if(count($filterAdmission['today']) > 0)
                                            {{ number_format($filterAdmission['today']->sum('advance'), 2) }}. Tk
                                        @elseif(count($filterAdmission['yesterday']) > 0)
                                            {{ number_format($filterAdmission['yesterday']->sum('advance'), 2) }}. Tk
                                        @elseif(count($filterAdmission['last7Days']) > 0)
                                            {{ number_format($filterAdmission['last7Days']->sum('advance'), 2) }}. Tk
                                        @elseif(count($filterAdmission['last15Days']) > 0)
                                            {{ number_format($filterAdmission['last15Days']->sum('advance'),2) }}. Tk
                                        @elseif(count($filterAdmission['last30Days']) > 0)
                                            {{ number_format($filterAdmission['last30Days']->sum('advance'),2) }}. Tk
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
                                        @if(count($filterAdmission['today']) > 0)
                                            {{ number_format($filterAdmission['today']->sum('due'), 2) }}. Tk
                                        @elseif(count($filterAdmission['yesterday']) > 0)
                                            {{ number_format($filterAdmission['yesterday']->sum('due'), 2) }}. Tk
                                        @elseif(count($filterAdmission['last7Days']) > 0)
                                            {{ number_format($filterAdmission['last7Days']->sum('due'), 2) }}. Tk
                                        @elseif(count($filterAdmission['last15Days']) > 0)
                                            {{ number_format($filterAdmission['last15Days']->sum('due'),2) }}. Tk
                                        @elseif(count($filterAdmission['last30Days']) > 0)
                                            {{ number_format($filterAdmission['last30Days']->sum('due'),2) }}. Tk
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
                                    <option value="{{ \Carbon\Carbon::today() }}">Today</option>
                                    <option value="{{ \Carbon\Carbon::yesterday() }}">Yesterday</option>
                                    <option value="{{ \Carbon\Carbon::now()->subDays(7) }}">Last 7 Days</option>
                                    <option value="{{ \Carbon\Carbon::now()->subDays(15) }}">Last 15 Days</option>
                                    <option value="{{ \Carbon\Carbon::now()->subDays(30) }}">Last 30 Days</option>
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
                                        @if(count($filterExpanse['todayExpanse']) > 0)
                                            {{ number_format($filterExpanse['todayExpanse']->sum('price'), 2) }}. Tk
                                        @elseif(count($filterExpanse['yesterdayExpanse']) > 0)
                                            {{ number_format($filterExpanse['yesterdayExpanse']->sum('price'), 2) }}. Tk
                                        @elseif(count($filterExpanse['last7DaysExpanse']) > 0)
                                            {{ number_format($filterExpanse['last7DaysExpanse']->sum('price'), 2) }}. Tk
                                        @elseif(count($filterExpanse['last15DaysExpanse']) > 0)
                                            {{ number_format($filterExpanse['last15DaysExpanse']->sum('price'),2) }}. Tk
                                        @elseif(count($filterExpanse['last30DaysExpanse']) > 0)
                                            {{ number_format($filterExpanse['last30DaysExpanse']->sum('price'),2) }}. Tk
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

        var labels =  {{ Js::from($labels) }};
        var users =  {{ Js::from($data) }};

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
