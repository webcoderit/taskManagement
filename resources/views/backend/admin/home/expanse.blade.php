@extends('backend.admin.admin-master')

@section('content')
<div class="wrapper">
    <div class="page-wrapper" style="margin-left: 20px!important;">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Expanse</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Expanse</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if(Session::has('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!--end breadcrumb-->
            <hr/>
            <div class="card">
                <div class="card-body">
                    <span style="font-weight: 600; font-size: 18px;">Expanse Filtering</span>
                    <div class="row">
                        <form class="form-group" action="{{ url('/admin/user/expanse/list') }}" method="get">
                            @csrf
                            <div class="col-md-12 m-auto">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label style="font-weight: 600;margin-bottom: 5px;">Select Bill Type</label><br>
                                        <select name="bill_type" id="bill-type" class="form-control">
                                            <option selected disabled>--- Select Bill Type ---</option>
                                            <option value="mobile">Mobile Bill</option>
                                            <option value="net">Net Bill</option>
                                            <option value="electricity">Electricity Bill</option>
                                            <option value="others">Others Bill</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label style="font-weight: 600;margin-bottom: 5px;">
                                            Date From
                                        </label><br>
                                        <input type="date" name="expanse_date" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label style="font-weight: 600;margin-bottom: 5px;">
                                            Date To
                                        </label><br>
                                        <input type="date" name="to_date" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                       <div class="input-group" style="margin-top: 25px;">
                                            <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
                                            <a href="{{ url('/admin/user/expanse/list') }}" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!--Report download-->
                        <span style="font-weight: 600; font-size: 18px; margin-top: 20px;">Expanse Report Download</span>
                        <form class="form-group" action="{{ url('/admin/user/expanse/list') }}" method="get">
                            @csrf
                            <div class="col-md-12 m-auto">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label style="font-weight: 600;margin-bottom: 5px;">
                                            Date From
                                        </label><br>
                                        <input type="date" name="from_date" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-weight: 600;margin-bottom: 5px;">
                                            Date To
                                        </label><br>
                                        <input type="date" name="to_date" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                       <div class="input-group" style="margin-top: 25px;">
                                            <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
                                            <a href="{{ url('/admin/user/expanse/list') }}" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>
                                            <a href="{{ url('/admin/user/expanse/list/download/'.request()->from_date . '/' . request()->to_date) }}" class="input-group-text btn btn-success" id="basic-addon3" style="margin-left: 20px;">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--Report download-->

                        <span style="font-weight: 600; font-size: 18px;" class="mt-5">Employee Mobile Minute Filtering</span>
                        <form action="{{ url('/admin/user/expanse/list') }}" method="get" class="mt-2">
                            @csrf
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label style="font-weight: 600;margin-bottom: 5px;">Select Bill Type</label><br>
                                        <select name="bill_type" id="bill-type" class="form-control">
                                            <option selected disabled>--- Select Bill Type ---</option>
                                            <option value="mobile">Mobile Bill</option>
                                            <option value="net">Net Bill</option>
                                            <option value="electricity">Electricity Bill</option>
                                            <option value="others">Others Bill</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label style="font-weight: 600;margin-bottom: 5px;">Select A User</label><br>
                                        <select name="user_id" id="user_id" class="form-control">
                                            <option selected disabled>--- Select A User ---</option>
                                            @foreach(\App\Models\User::all() as $user)
                                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group" style="margin-top: 25px;">
                                            <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
                                            <a href="{{ url('/admin/user/expanse/list') }}" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>User name</th>
                                <th>Amount</th>
                                <th>Minute</th>
                                <th width="40%">Purpose</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $sum = 0;
                                $minute = 0
                            @endphp
                            @foreach($expanses as $expanse)
                                <tr>
                                    <td>{{ date('Y-m-d', strtotime($expanse->created_at))  }}</td>
                                    <td>{{ $expanse->user->full_name ?? 'Admin' }}</td>
                                    <td>{{ number_format($expanse->price,2) }}</td>
                                    <td>{{ $expanse->minute }}</td>
                                    <td>{{ ucfirst($expanse->note) }}</td>
                                </tr>
                                @php
                                    $sum += $expanse->price;
                                    $minute += $expanse->minute
                                @endphp
                            @endforeach
                            <tr>
                                <td width="8%">
                                    <span></span>
                                </td>
                                <td></td>
                                <td>
                                    <span style="font-weight: bold">Total Amount : {{ number_format($sum,2) }}</span>
                                </td>
                                <td><span style="font-weight: bold">Total Minute : {{ $minute ?? '' }}</span> </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
{{--                    {{ $expanses->links() }}--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
