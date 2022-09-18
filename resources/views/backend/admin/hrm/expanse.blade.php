@extends('backend.admin.hr-master')

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
                            <li class="breadcrumb-item"><a href="{{ url('/admin/hr/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Expanse</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Expanse</h6>
            <div class="add-expanse-btn-outer" style="text-align: end;">
                <a href="{{ url('/add/expanse') }}" style="display: inline-block;background: #f16522;color: #fff;padding: 7px 12px;border-radius: 5px;">
                    Add Expanse
                </a>
            </div>
            <hr/>
            <div class="card">
                <div class="card-body">
{{--                    <div class="row">--}}
{{--                        <form class="form-group" action="{{ url('/expanse') }}" method="get">--}}
{{--                            @csrf--}}
{{--                            <div class="col-md-6 m-auto">--}}
{{--                                <div class="input-group mb-2">--}}
{{--                                    <input type="date" name="expanse_date" class="form-control">--}}
{{--                                    <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>--}}
{{--                                    <a href="{{ url('/expanse') }}" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
                    <form action="{{ url('/expanse') }}" method="get" class="form-group">
                        @csrf
                        <div class="col-md-12">
                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-5">
                                    <label>From date</label>
                                    <div class="input-group mb-2">
                                        <input type="date" name="from_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label>To date</label>
                                    <div class="input-group mb-2">
                                        <input type="date" name="to_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2" style="margin-top: 20px;">Search</button>
                                    <a href="{{ url('/expanse') }}" class="input-group-text btn btn-danger" id="basic-addon2" style="margin-top: 20px;">Clear</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>User name</th>
                                <th>Bill Type</th>
                                <th>Amount</th>
                                <th>Minute</th>
                                <th width="40%">Note</th>
{{--                                <th width="15%">Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $sum = 0
                            @endphp
                            @foreach($expanses as $expanse)
                                <tr>
                                    <td>{{ date('Y-m-d', strtotime($expanse->created_at))  }}</td>
                                    <td>{{ $expanse->user->full_name ?? 'HR Admin' }}</td>
                                    <td>{{ ucfirst($expanse->bill_type)  }} Bill</td>
                                    <td>{{ number_format($expanse->price,2) }}</td>
                                    <td>{{ $expanse->minute ?? '0' }} Minute</td>
                                    <td>{{ ucfirst($expanse->note) }}</td>
{{--                                    <td>--}}
{{--                                        <a href="{{ url('/edit/expanse/'.$expanse->id) }}" class="btn btn-info">--}}
{{--                                            <i class="bx bx-edit-alt"></i>--}}
{{--                                        </a>--}}
{{--                                        --}}{{-- <a href="{{ url('/delete/expanse/'.$expanse->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure delete this information ?')">--}}
{{--                                            <i class="bx bx-trash-alt"></i>--}}
{{--                                        </a> --}}
{{--                                    </td>--}}
                                </tr>
                                @php
                                    $sum += $expanse->price
                                @endphp
                            @endforeach
                            <tr>
                                <td width="8%">
                                    <span></span>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <span style="font-weight: bold">Total Amount : {{ number_format($sum,2) }}</span>
                                </td>
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
