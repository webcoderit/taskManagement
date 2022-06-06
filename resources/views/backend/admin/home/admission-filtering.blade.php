@extends('backend.admin.admin-master')

@section('content')
<div class="wrapper">
    <div class="page-wrapper" style="margin-left: 20px!important;">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Admission</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Admission Filter</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Admission Filtering</h6>
            <hr/>
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
                                            <option value="saidul">Saidul</option>
                                            <option value="saidul">Saidul</option>
                                            <option value="saidul">Saidul</option>
                                            <option value="saidul">Saidul</option>
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
                                                <option value="3565">45454</option>
                                                <option value="3565">45454</option>
                                                <option value="3565">45454</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group" style="margin-top: 25px;">
                                            <button type="submit" class="input-group-text btn btn-primary">
                                                Search
                                            </button>
                                            <a href="{{ url('/admin/dashboard') }}" class="input-group-text btn btn-danger">
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
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
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
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
