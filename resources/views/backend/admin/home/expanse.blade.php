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
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Expanse</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Expanse</h6>
            <div class="add-expanse-btn-outer" style="text-align: end;">
                
            </div>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form class="form-group" action="{{ url('/admin/user/expanse/list') }}" method="get">
                            @csrf
                            <div class="col-md-6 m-auto">
                                <div class="input-group mb-2">
                                    <input type="date" name="expanse_date" class="form-control">
                                    <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
                                    <a href="{{ url('/admin/user/expanse/list') }}" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th width="40%">Note</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $sum = 0
                            @endphp
                            @foreach($expanses as $expanse)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ date('Y-m-d', strtotime($expanse->created_at))  }}</td>
                                    <td>{{ number_format($expanse->price,2) }}</td>
                                    <td>{{ ucfirst($expanse->note) }}</td>
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
                                <td>
                                    <span style="font-weight: bold">Total Amount : {{ number_format($sum,2) }}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    {{ $expanses->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
