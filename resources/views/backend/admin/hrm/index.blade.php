@extends('backend.admin.hr-master')

@section('title')

@endsection

@section('content')
<div class="page-content">
    <div class="">
        <!--Admission debit and credit calculation-->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5 row-cols-xxl-5">
            <div class="col">
                <div class="card radius-10" style="background-color: #0bb2d3">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Today Admission Advance</p>
                        <h3 class="mb-3 text-white">
                            {{ number_format($todayCredit,2 ?? 0) }}
                        </h3>
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: darkred">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Today Admission Due</p>
                        <h3 class="mb-3 text-white">{{ number_format($todayDue,2 ?? 0) }}</h3>
                        <div id="chart4"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: rebeccapurple">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Admission Due</p>
                        <h3 class="mb-3 text-white">{{ number_format($monthlyDebit,2 ?? 0) }}</h3>
                        <div id="chart3"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: deepskyblue">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Due Collect</p>
                        <h3 class="mb-3 text-white">{{ number_format($monthlyDueCollect,2 ?? 0) }}</h3>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col col-md-12">
                <div class="card radius-10" style="background-color: orangered">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Today Due Collect</p>
                        <h3 class="mb-3 text-white">{{ number_format($todayDueCollect, 2) }}</h3>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: lightskyblue">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Today Expanse</p>
                        <h3 class="mb-3 text-white">{{ number_format(\App\Models\Expance::whereDate('created_at', \Carbon\Carbon::today())->get()->sum('price'),2) }}</h3>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col col-md-12">
                <div class="card radius-10" style="background-color: darkseagreen">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Expanse</p>
                        <h3 class="mb-3 text-white">{{ number_format(\App\Models\Expance::whereMonth('created_at', date('m'))->get()->sum('price'),2) }}</h3>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>
@endsection

@push('script')
{{--    <script>--}}
{{--        setInterval(function() {--}}
{{--            window.location.reload();--}}
{{--        }, 10000);--}}
{{--    </script>--}}
@endpush
