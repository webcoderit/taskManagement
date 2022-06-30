@extends('backend.admin.hr-master')

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
                            <li class="breadcrumb-item"><a href="{{ url('/hr/dashboard') }}"><i class="bx bx-home-alt"></i></a>
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
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Total Fee</th>
                                <th>Advance</th>
                                <th>Due</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($moneyReceipt as $receipt)
                                <tr>
                                    <td>{{ $receipt->moneyReceipt->admission_date->format('Y-m-d') ?? '' }}</td>
                                    <td>{{ $receipt->s_name?? '' }}</td>
                                    <td>{{ number_format($receipt->moneyReceipt->total_fee,2) ?? '' }} tk</td>
                                    <td>{{ number_format($receipt->moneyReceipt->advance,2) ?? '' }} tk</td>
                                    <td>{{ number_format($receipt->moneyReceipt->due,2) ?? '' }} tk</td>
                                    <td width="15%">
                                        <a href="{{ url('/admin/money/receipt/view/'.$receipt->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bx bx-edit-alt"></i>
                                            View
                                        </a>
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
