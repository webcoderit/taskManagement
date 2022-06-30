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
                            {{ number_format($data['todayAmounts']->sum('advance'),2 ?? 0) }}
                        </h3>
                        <span style="background-color: purple;
                            color: white;
                            padding: 10px 40px;
                            font-size: 16px;
                            font-weight: 700;
                            border-radius: 5px;">
                            {{ \App\Models\AdmissionForm::whereDate('created_at', \Carbon\Carbon::today())->count() }}
                        </span>
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: darkred">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Today Admission Due</p>
                        <h3 class="mb-3 text-white">{{ number_format($data['todayAmounts']->sum('due'),2 ?? 0) }}</h3>
                        <div id="chart4"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: rebeccapurple">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Admission Due</p>
                        <h3 class="mb-3 text-white">{{ number_format($data['monthlyAmounts']->sum('due'),2 ?? 0) }}</h3>
                        <div id="chart3"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: deepskyblue">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Admission Advance</p>
                        <h3 class="mb-3 text-white">{{ number_format($data['monthlyAmounts']->sum('advance'),2 ?? 0) }}</h3>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col col-md-12">
                <div class="card radius-10" style="background-color: orangered">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Today Due Collect</p>
                        <h3 class="mb-3 text-white">{{ number_format($data['todayAmounts']->sum('today_pay'), 2) }}</h3>
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
            <div class="col">
                <div class="card radius-10" style="background-color: darkseagreen">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Expanse</p>
                        <h3 class="mb-3 text-white">{{ number_format(\App\Models\Expance::whereMonth('created_at', date('m'))->get()->sum('price'),2) }}</h3>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: #CD5C5C">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly ADM Admission</p>
                        <h3 class="mb-3 text-white">{{ \App\Models\AdmissionForm::where('course', 'digital')->whereMonth('created_at', date('m'))->count() ?? 0 }}</h3>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: #6495ED">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Web Admission</p>
                        <h3 class="mb-3 text-white">{{ \App\Models\AdmissionForm::where('course', 'web')->whereMonth('created_at', date('m'))->count() ?? 0 }}</h3>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col col-md-12">
                <div class="card radius-10" style="background-color: #800080">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly English Admission</p>
                        <h3 class="mb-3 text-white">{{ \App\Models\AdmissionForm::where('course', 'english')->whereMonth('created_at', date('m'))->count() ?? 0 }}</h3>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="search-form-wrapper card p-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form class="form-group" action="{{ url('/admin/hr/dashboard') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="user_id" style="font-weight: 600; margin-bottom: 5px;">
                                    Employee Name
                                </label><br>
                                <select name="user_id" class="form-control">
                                    <option selected disabled>--- Select Employee Name ---</option>
                                    @foreach($data['users'] as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="date" style="font-weight: 600; margin-bottom: 5px;">
                                    Date
                                </label><br>
                                <input type="date" name="date" class="form-control" placeholder="Date">
                            </div>
                            <div class="col-md-3">
                                <label for="batch" style="font-weight: 600; margin-bottom: 5px;">
                                    Batch No
                                </label><br>
                                <select name="batch_no" id="batchNo" class="form-control">
                                    <option selected disabled>--- Select Batch No ---</option>
                                    @foreach($data['admissionStudentsBatch'] as $batchNo)
                                        <option value="{{ $batchNo[0]->batch_no }}">{{ ucfirst($batchNo[0]->course) }} - {{ ucfirst($batchNo[0]->batch_no) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group" style="margin-top: 25px;">
                                    <button type="submit" class="input-group-text btn btn-primary">
                                        Search
                                    </button>
                                    <a href="{{ url('/admin/hr/dashboard') }}" class="input-group-text btn btn-danger">
                                        Clear
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee Name</th>
                            <th>Course Name</th>
                            <th>Batch</th>
                            <th>Student Name</th>
                            <th>Student Phone</th>
                            <th>Student Email</th>
                            <th>Total Fee</th>
                            <th>Advance</th>
                            <th>Due</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $sum = 0
                    @endphp
                    @foreach($admissionStudents as $admissionStudent)
                        <tr>
                            <td>{{ $admissionStudent->moneyReceipt->admission_date->format('Y-m-d') }}</td>
                            <td>{{ $admissionStudent->user->full_name?? '' }}</td>
                            <td>
                                @if($admissionStudent->course == 'web')
                                    Full stack web development
                                @elseif($admissionStudent->course == 'digital')
                                    Advanced digital marketing
                                @else
                                    Communication english
                                @endif
                            </td>
                            <td>{{ $admissionStudent->batch_no?? '' }}</td>
                            <td>{{ $admissionStudent->s_name?? '' }}</td>
                            <td>{{ $admissionStudent->s_phone ?? '' }}</td>
                            <td>{{ $admissionStudent->s_email ?? '' }}</td>
                            <td>{{ $admissionStudent->moneyReceipt->total_fee ?? '' }}Tk.</td>
                            <td>{{ $admissionStudent->moneyReceipt->advance ?? '' }}Tk.</td>
                            <td>{{ $admissionStudent->moneyReceipt->due ?? '' }}Tk.</td>
                            <td>Checked</td>
                        </tr>
                        @php
                            $sum += $admissionStudent->moneyReceipt->advance
                        @endphp
                    @endforeach
                    <tr>
                        <td colspan="8"></td>
                        <td>
                            <span style="font-weight: bold">Total Amount : {{ number_format($sum,2) }}</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                {{ $admissionStudents->links() }}
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
