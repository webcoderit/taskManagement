@extends('backend.admin.master')

@section('content')
<div class="wrapper">
    <div class="page-wrapper" style="margin-left: 20px!important;">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Addmission List</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/employee/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <!-- <li class="breadcrumb-item active" aria-current="page">
                                <a href="#">List Task</a>
                            </li>  -->
                            <li class="breadcrumb-item active" aria-current="page">Addmission List</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Addmission List</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Course Name</th>
                                <th>Name</th>
                                <th>Profession</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admissionForms as $admissionForm)
                                <tr>
                                    <td>{{ $admissionForm->moneyReceipt->admission_date ?? '' }}</td>
                                    <td>
                                        @if($admissionForm->course == 'web')
                                            <span>Full Stack Web Development</span>
                                        @elseif($admissionForm->course == 'digital')
                                            <span>Digital Marketing</span>
                                        @else
                                            <span>Communication English</span>
                                        @endif
                                    </td>
                                    <td>{{ $admissionForm->s_name }}</td>
                                    <td>{{ $admissionForm->profession }}</td>
                                    <td>{{ $admissionForm->s_phone }}</td>
                                    <td>{{ $admissionForm->gender }}</td>
                                    <td width="15%">
                                        <a href="" class="btn btn-sm btn-primary">
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
