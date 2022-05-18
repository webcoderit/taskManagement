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
                <a href="{{ url('admin/add/expanse') }}" style="display: inline-block;background: #f16522;color: #fff;padding: 7px 12px;border-radius: 5px;">
                    Add Expanse
                </a>
            </div>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>21</td>
                                    <td>Saidul</td>
                                    <td>12000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
