@extends('backend.admin.master')

@section('content')
<div class="wrapper">
    <div class="page-wrapper" style="margin-left: 20px!important;">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Money Receipt</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/employee/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <!-- <li class="breadcrumb-item active" aria-current="page">
                                <a href="#">List Task</a>
                            </li>  -->
                            <li class="breadcrumb-item active" aria-current="page">Money Receipt</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Money Receipt</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <form class="form-group" action="{{ url('/money/receipt') }}" method="get">
                        @csrf
                        <div class="col-md-12" style="padding-left: 10%;">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <input type="number" name="search" class="form-control" placeholder="Enter Batch Number">
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
                                        <a href="{{ url('/money/receipt') }}" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>
                                    </div>
                                </div>
                                <div class="col-md-2" style="text-align-last: end;"></div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Admission Date</th>
                                <th>Due Clear Date</th>
                                <th>Batch No</th>
                                <th>Name</th>
                                <th>Total Fee</th>
                                <th>First Payment</th>
                                <th>Second Payment</th>
                                <th>Due Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($moneyReceipt as $receipt)
                                <tr>
                                    <td>{{ $receipt->moneyReceipt->admission_date->format('Y-m-d') ?? '' }}</td>
                                    <td>{{ $receipt->moneyReceipt->updated_at->format('Y-m-d') ?? '' }}</td>
                                    <td>{{ $receipt->batch_no?? '' }}</td>
                                    <td>{{ $receipt->s_name?? '' }}</td>
                                    <td>{{ number_format($receipt->moneyReceipt->total_fee,2) ?? '' }} tk</td>
                                    <td>{{ number_format($receipt->moneyReceipt->advance,2) ?? '' }} tk</td>
                                    <td>{{ number_format($receipt->moneyReceipt->today_pay,2).'Tk' ?? 'Not yet' }}</td>
                                    <td>
                                        @if($receipt->moneyReceipt->due == 0)
                                            <span class="badge rounded-pill bg-success">Paid</span>
                                        @else
                                            {{ $receipt->moneyReceipt->due ?? '' }}
                                        @endif
                                    </td>
                                    <td width="15%">
                                        <a href="{{ url('/money/receipt/view/'.$receipt->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bx bx-edit-alt"></i>
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $moneyReceipt->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
