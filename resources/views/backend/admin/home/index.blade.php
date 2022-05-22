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
                      <h3 class="mb-3">{{ count(\App\Models\AdmissionForm::whereDate('created_at', \Carbon\Carbon::today())->get()) }}</h3>
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
        </div>
    </div>
   </div>

<div class="wrapper">
    <div class="page-wrapper" style="margin-left: 20px!important;">
        <div class="page-content">
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Employee Tracking list</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>In time</th>
                                <th>Out time</th>
                                <th>Active Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    @if($user->status == 1)
                                        <td class="user-online-offline-b">
                                            <img src="{{ asset('/avatar/'.$user->avatar) }}" height="30" width="30" style="border-radius: 50%" />
                                            {{ $user->full_name ?? 'No name found' }}
                                        </td>
                                    @else
                                        <td class="user-online-offline-c">
                                            <img src="{{ asset('/avatar/'.$user->avatar) }}" height="30" width="30" style="border-radius: 50%" />
                                            {{ $user->full_name ?? 'No name found' }}
                                        </td>
                                    @endif
                                    <td>{{ $user->in_time != null ? $user->in_time->format('g:i a') : '00:00' }}</td>
                                    <td>{{ $user->out_time != null ? $user->out_time->format('g:i a') : '00:00' }}</td>
                                    <td>
                                        @if($user->status == 1)
                                            <span class="custom-green-badge">Active</span>
                                        @else
                                            <span class="custom-red-badge">{{ $user->updated_at->diffforhumans() }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        setInterval(function() {
            window.location.reload();
        }, 10000);
    </script>
@endpush
