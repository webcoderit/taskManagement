@extends('backend.admin.hr-master')

@section('title')

@endsection

@section('content')
<div class="page-content">
    <div class="">
        <!--Admission debit and credit calculation-->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5 row-cols-xxl-5">
            <a href="{{ url('/admin/user/today/admission/list') }}">
                <div class="col">
                    <div class="card radius-10" style="background-color: #0bb2d3">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Today Admission Advance</p>
                            <h3 class="mb-3 text-white">
                                {{ number_format($data['todayAmountsAdvance']->sum('advance'),2 ?? 0) }}
                            </h3>
                            <span style="background-color: purple;
                            color: white;
                            padding: 10px 40px;
                            font-size: 16px;
                            font-weight: 700;
                            border-radius: 5px;">
                            {{ count(\App\Models\MoneyReceipt::whereDate('admission_date', \Carbon\Carbon::today())->get()) }}
                        </span>
                            <div id="chart1"></div>
                        </div>
                    </div>
                </div>
            </a>
            <div class="col">
                <div class="card radius-10" style="background-color: darkred">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Today Admission Due</p>
                        <h3 class="mb-3 text-white">{{ number_format($data['todayAmountsDue']->sum('due'),2 ?? 0) }}</h3>
                        <div id="chart4"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: deepskyblue">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Admission Advance</p>
                        <h3 class="mb-3 text-white">{{ number_format($data['monthlyAmountsAdvance']->sum('advance'),2 ?? 0) }}</h3>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: rebeccapurple">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Admission Due</p>
                        <h3 class="mb-3 text-white">{{ number_format($data['monthlyAmountsDue']->sum('due'),2 ?? 0) }}</h3>
                        <div id="chart3"></div>
                    </div>
                </div>
            </div>
            <div class="col col-md-12">
                <div class="card radius-10" style="background-color: orangered">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Today Due Collect</p>
                        <h3 class="mb-3 text-white">{{ \App\Models\MoneyReceipt::whereDate('updated_at', \Carbon\Carbon::today())->sum('today_pay') }}</h3>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
            <div class="col col-md-12">
                <div class="card radius-10" style="background-color: hotpink">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Due Collect</p>
                        <h3 class="mb-3 text-white">{{ \App\Models\MoneyReceipt::whereMonth('updated_at', \Carbon\Carbon::now()->format('m'))->sum('today_pay') }}</h3>
                        <div id="chart5"></div>
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
                        <h3 class="mb-3 text-white">{{ count($data['monthlyAdmAdmission']) ?? 0 }}</h3>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10" style="background-color: #6495ED">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly Web Admission</p>
                        <h3 class="mb-3 text-white">{{ count($data['monthlyWebAdmission']) ?? 0 }}</h3>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col col-md-12">
                <div class="card radius-10" style="background-color: #800080">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Monthly English Admission</p>
                        <h3 class="mb-3 text-white">{{ count($data['monthlyEngAdmission']) ?? 0 }}</h3>
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
                                        <option value="{{ $batchNo->batch_no }}">{{ ucfirst($batchNo->course_name) }} - {{ ucfirst($batchNo->batch_no) }}</option>
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
    <form action="{{ url('/admin/admission/checked') }}" method="post">
        @csrf
        <div class="card">
            <div class="card-body">
                @if(Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ Session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                <div class="table-responsive">
                    <table id="" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th></th>
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
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($admissionStudents))
                            @php
                                $sum = 0
                            @endphp
                            @foreach($admissionStudents as $admissionStudent)
                                <tr>
                                    @if($admissionStudent->admin_check == null)
                                        <td>
                                            <input type="checkbox" name="admin_check[]" value="{{ $admissionStudent->id }}" />
                                        </td>
                                    @else
                                        <td>
                                            <span class="badge rounded-pill bg-success">Checked</span>
                                        </td>
                                    @endif
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
                                    <td>{{ $admissionStudent->moneyReceipt->transaction_id ?? '' }}</td>
                                    <td>{{ $admissionStudent->moneyReceipt->total_fee ?? '' }}Tk.</td>
                                    <td>{{ $admissionStudent->moneyReceipt->advance ?? '' }}Tk.</td>
                                    <td>{{ $admissionStudent->moneyReceipt->due ?? '' }}Tk.</td>
                                </tr>
                                @php
                                    $sum += $admissionStudent->moneyReceipt->advance
                                @endphp
                            @endforeach
                            <tr>
                                <td colspan="7"></td>
                                <td>Total Student : {{ count($admissionStudents) ?? 0 }}</td>
                                <td>
                                    <span style="font-weight: bold">Total Amount : {{ number_format($sum,2) }}</span>
                                </td>
                                <td colspan="3">
                                    <button type="submit" class="btn btn-sm btn-success float-end">Update</button>
                                </td>
                            </tr>
                        </tbody>
                        @else
                            <tr>
                                <td colspan="11">
                                    <p class="text-center mt-3">Please Select Employee Name or Batch No or Date and Then Hit Search</p>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('script')
{{--    <script>--}}
{{--        setInterval(function() {--}}
{{--            window.location.reload();--}}
{{--        }, 10000);--}}
{{--    </script>--}}
@endpush
