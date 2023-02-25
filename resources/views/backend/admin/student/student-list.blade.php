@extends('backend.admin.admin-master')

@section('content')
    <div class="wrapper">
        <div class="page-wrapper" style="margin-left: 20px!important;">
            <div class="page-content">
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ Session::get('success') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Student List</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Student List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="col-md-12">
                    <form action="{{ url('/admin/students/list') }}" method="get">
                        @csrf
                        <div class="row" style="padding: 0px 100px;">
                            <div class="col-md-5">
                                <label for="phone" style="font-weight: 600;">
                                    Phone
                                </label><br>
                                <input type="number" name="phone" placeholder="Phone" class="form-control">
                            </div>
                            <div class="col-md-7">
                                @csrf
                                <label for="phone" style="font-weight: 600;">
                                    Batch No.
                                </label><br>
                                <div class="input-group mb-3">
                                    <select class="form-control" name="batch_no">
                                        <option selected disabled>----Select A Batch No----</option>
                                        @foreach($data['admissionStudentsBatch'] as $admissionStudentBatch)
                                            <option value="{{ $admissionStudentBatch[0]->batch_no }}">{{ ucfirst($admissionStudentBatch[0]->course) }} - {{ ucfirst($admissionStudentBatch[0]->batch_no) }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
                                    <a href="{{ url('/admin/students/list') }}" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <hr/>
                <div class="col-md-12">
                    <form action="{{ url('/admin/students/list') }}" method="get">
                        @csrf
                        <div class="" style="padding: 0px 100px;">
                            <div class="">
                                <label for="batchStudent" style="font-weight: 600;">
                                    Batch No.
                                </label><br>
                                <div class="input-group mb-3">
                                    <select class="form-control" name="batch_student">
                                        <option selected disabled>----Select A Batch No----</option>
                                        @foreach($data['admissionStudentsBatch'] as $admissionStudentBatch)
                                            <option value="{{ $admissionStudentBatch[0]->batch_no }}">{{ ucfirst($admissionStudentBatch[0]->batch_no) }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
                                    <a href="{{ url('/admin/students/list') }}" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>
                                    <a href="#" class="input-group-text btn btn-info" style="margin-left: 30px;" id="basic-addon2">{{ 'Total Student: ' . count($admissionStudents) }}</a>
                                    @if(request()->batch_student)
                                        <a href="{{ url('/admin/user/student/batch/wise/list/'.request()->batch_student) }}" class="input-group-text btn btn-primary" style="margin-left: 30px;" id="basic-addon2">Download</a>
                                        <a class="btn btn-success float-right" href="{{ url('/admin/file-export/'.request()->batch_student) }}">Excel report</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <hr/>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Marketing Officer Name</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Course Name</th>
                                    <th>Batch No</th>
                                    <th>Course Fee</th>
                                    <th>First Payment</th>
                                    <th>Second Payment</th>
                                    <th>Due</th>
                                    <th>Due Opinion</th>
                                    <th>Online Charge</th>
                                    <th>Admission Opinion</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($admissionStudents as $admissionStudent)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $admissionStudent->user->full_name?? '' }}</td>
                                        <td>{{ $admissionStudent->s_name?? '' }}</td>
                                        <td>{{ $admissionStudent->s_email ?? '' }}</td>
                                        <td>{{ $admissionStudent->s_phone ?? '' }}</td>
                                        <td>
                                            @if($admissionStudent->course == 'web')
                                                Full stack web development
                                            @elseif($admissionStudent->course == 'digital')
                                                Advance digital marketing
                                            @elseif($admissionStudent->course == 'attachment_web')
                                                Industrial Attachment ( Web )
                                            @elseif($admissionStudent->course == 'attachment_adm')
                                                Industrial Attachment ( Adm )
                                            @else
                                                Communication english
                                            @endif
                                        </td>
                                        <td>{{ $admissionStudent->batch_no?? '' }}</td>
                                        <td>{{ $admissionStudent->moneyReceipt->total_fee ?? '' }}Tk.</td>
                                        <td>{{ $admissionStudent->moneyReceipt->advance ?? '' }}Tk.</td>
                                        <td>{{ $admissionStudent->moneyReceipt->today_pay ?? '' }}Tk.</td>
                                        <td>
                                            @if($admissionStudent->moneyReceipt->due == 0)
                                                Paid
                                            @else
                                                {{ $admissionStudent->moneyReceipt->due ?? '' }}
                                            @endif
                                        </td>
                                        <td>{{ $admissionStudent->note ?? '' }}</td>
                                        <td>{{ $admissionStudent->moneyReceipt->online_charge ?? '' }}</td>
                                        <td>{{ $admissionStudent->other_admission_note ?? '' }}</td>

                                        <td>
                                            @if($admissionStudent->moneyReceipt->due == 0)
                                                <a href="#" class="btn btn-sm btn-success">
                                                    <i class="bx bx-check-circle"></i>
                                                </a>
                                            @else
                                                <a href="{{ url('/admin/admission/student/due/'.$admissionStudent->moneyReceipt->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="bx bx-user-circle"></i>
                                                </a>
                                            @endif
                                            <a href="{{ url('/admin/admission/form/edit/'.$admissionStudent->id) }}" class="btn btn-sm btn-info">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>
                                            <a href="{{ url('/admin/admission/student/info/delete/'.$admissionStudent->id) }}" onclick="return confirm('Are you sure delete this student info ?')" class="btn btn-sm btn-danger">
                                                <i class="bx bx-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $admissionStudents->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection
