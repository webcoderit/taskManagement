@extends('backend.admin.admin-master')

@section('content')
<div class="wrapper">
    <div class="page-wrapper" style="margin-left: 20px!important;">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Task Summery</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">
                                <a href="#">List Task</a>
                            </li> --}}
                            <li class="breadcrumb-item active" aria-current="page">Task Summery</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Task Summery</h6>
            <hr/>
            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ Session::get('error') }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/admin/task/summery') }}" method="get" class="form-group">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>From date</label>
                                    <div class="input-group mb-2">
                                        <input type="date" name="from_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>To date</label>
                                    <div class="input-group mb-2">
                                        <input type="date" name="to_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2" style="margin-top: 20px;">Search</button>
                                    <a href="{{ url('/admin/task/summery') }}" class="input-group-text btn btn-danger" id="basic-addon2" style="margin-top: 20px;">Clear</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Employee name</th>
                                <th>Total Task</th>
                                <th>Highly Interested</th>
                                <th>50% Interested</th>
                                <th>Not Interested</th>
                                <th>Others</th>
                                <th>Admission</th>
                                <th>Performance KPI</th>
                            </tr>
                            </thead>
                            @if(!empty($tasks))
                            <tbody>
                                @foreach($tasks as $key => $task)
                                    <tr>
                                        <td>{{ $loop->index+1}}</td>
                                        <td>{{ $task[0]->user->full_name ?? 'No employee name' }}</td>
                                        <td>{{ $totalAssignTask = count($task) }}</td>
                                        <td>
                                            @if(isset($task[$key]))
                                                {{ $task[$key]->where('user_id', $task[$key]->user->id)->whereHas('interestes', function ($q){
                                                $q->where('interest_level', 'highly')->whereDate('created_at', '>=', request()->from_date)->whereDate('created_at', '<=', request()->to_date);
                                                })->count() }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($task[$key]))
                                                {{ $task[$key]->where('user_id', $task[$key]->user->id)->whereHas('interestes', function ($q){
                                                $q->where('interest_level', '50%')->whereDate('created_at', '>=', request()->from_date)->whereDate('created_at', '<=', request()->to_date);
                                                })->count() }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($task[$key]))
                                                {{ $notInterested = $task[$key]->where('user_id', $task[$key]->user->id)->whereHas('interestes', function ($q){
                                                $q->where('interest_level', 'not')->whereDate('created_at', '>=', request()->from_date)->whereDate('created_at', '<=', request()->to_date);
                                                })->count() }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($task[$key]))
                                                {{ $task[$key]->where('user_id', $task[$key]->user->id)->whereHas('interestes', function ($q){
                                                $q->where('interest_level', 'others')->whereDate('created_at', '>=', request()->from_date)->whereDate('created_at', '<=', request()->to_date);
                                                })->count() }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($task[$key]))
                                                {{ $totalAdmission = $task[0]->user->admissions()->whereHas('moneyReceipt', function ($m){
                                                $m->whereDate('admission_date', '>=', request()->from_date)->whereDate('admission_date', '<=', request()->to_date);
                                            })->count() }}
                                            @endif
                                        </td>
                                        @php
                                           $subTotal = $totalAssignTask - isset($notInterested);;
                                        @endphp
                                        <td>
                                            @if(isset($task[$key]))
                                                {{ $totalAdmission*100/$subTotal ? number_format($totalAdmission*100/$subTotal,2) : 0 }}%
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @else
                                <tr>
                                    <td colspan="11">
                                        <p class="text-center mt-3">Please Select From Date and To Date Then Hit Enter/Search</p>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
