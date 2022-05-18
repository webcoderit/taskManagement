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
                <a href="#" data-toggle="modal" data-target="#addExpanse" style="display: inline-block;background: #f16522;color: #fff;padding: 7px 12px;border-radius: 5px;">
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

            {{-- Modal Html Start --}}
                <div class="modal fade" id="addExpanse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <h5 class="modal-title" id="exampleModalLabel">Add Expanse</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: #fff;border-radius: 5px;padding: 0px 7px;border: 2px solid #f16522;">
                                  <span aria-hidden="true" style="color: #f16522">&times;</span>
                                </button>
                            </div>
                            <form>
                                <div class="modal-body">
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label for="course_name" style="font-weight: 500;color: #000;margin-bottom: 5px;">Course Name</label>
                                        <input type="text" class="form-control" id="course_name" placeholder="Course Name">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label for="course_fee" style="font-weight: 500;color: #000;margin-bottom: 5px;">Course Fee</label>
                                        <input type="number" class="form-control" id="course_fee" placeholder="Course Fee">
                                    </div>
                                </div>
                                <div class="modal-footer border-top-0 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success" style="background-color: #f16522;border: 1px solid #f16522;">
                                          Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- Modal Html End --}}
        </div>
    </div>
</div>
@endsection
