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
                            <li class="breadcrumb-item active" aria-current="page">Admission Filtering Count</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Admission Filtering Count</h6>
            <hr/>
            <div class="search-form-wrapper card p-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-group" action="{{ url('/admin/user/admission/filtering') }}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="batch" style="font-weight: 600; margin-bottom: 5px;">
                                            Batch No:
                                        </label><br>
                                        <select name="batch_no" id="batchNo" class="form-control">
                                            <option selected disabled>--- Select Batch No ---</option>
                                            @foreach($data['batch'] as $batchNo)
                                                <option value="{{ $batchNo->batch_no }}">{{ ucfirst($batchNo->course_name) }} - {{ $batchNo->batch_no }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group" style="margin-top: 25px;">
                                            <button type="submit" class="input-group-text btn btn-primary">
                                                Search
                                            </button>
                                            <a href="{{ url('/admin/user/admission/filtering') }}" class="input-group-text btn btn-danger">
                                                Clear
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="batch" style="font-weight: 600; margin-bottom: 10px;">
                                            Total Student:
                                        </label><br>
                                        @if(isset($admissionStudents) > 0)
                                        <span class="total-student-count">
                                           {{ count($admissionStudents) }}
                                        </span>
                                        @endif
                                        @if(isset($admissionStudentsDateFiltering) > 0)
                                        <span class="total-student-count">
                                           {{ count($admissionStudentsDateFiltering) }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </form>
                            <form action="{{ url('/admin/user/admission/filtering') }}" method="get" class="form-group">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>From date</label>
                                            <div class="input-group mb-2">
                                                <input type="date" name="from_date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>To date</label>
                                            <div class="input-group mb-2">
                                                <input type="date" name="to_date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2" style="margin-top: 20px;">Search</button>
                                            <a href="{{ url('/admin/user/admission/filtering') }}" class="input-group-text btn btn-danger" id="basic-addon2" style="margin-top: 20px;">Clear</a>

                                            @if(isset($admissionStudentsDateFiltering) > 0)
                                                <a href="#" class="input-group-text btn btn-danger" id="basic-addon2" style="margin-top: 20px;">{{ count($admissionStudentsDateFiltering) }}</a>
                                            @endif
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
                        @if(isset($admissionStudentsDateFiltering))
                        <a href="{{ url('/admin/user/admission/filtering/report/download/'.request()->from_date . '/' . request()->to_date) }}" class="input-group-text btn btn-info float-end" id="basic-addon2" style="">Admission Report Download</a>
                        @endif
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>SL</th>
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
{{--                            @if(isset($admissionStudents))--}}
{{--                            <tbody>--}}
{{--                            @php--}}
{{--                                $sum = 0--}}
{{--                            @endphp--}}
{{--                            @foreach($admissionStudents as $admissionStudent)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ $admissionStudent->moneyReceipt->admission_date->format('Y-m-d') }}</td>--}}
{{--                                    <td>{{ $admissionStudent->user->full_name?? '' }}</td>--}}
{{--                                    <td>--}}
{{--                                        @if($admissionStudent->course == 'web')--}}
{{--                                            Full stack web development--}}
{{--                                        @elseif($admissionStudent->course == 'digital')--}}
{{--                                            Advanced digital marketing--}}
{{--                                        @else--}}
{{--                                            Communication english--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                    <td>{{ $admissionStudent->batch_no?? '' }}</td>--}}
{{--                                    <td>{{ $admissionStudent->s_name?? '' }}</td>--}}
{{--                                    <td>{{ $admissionStudent->s_phone ?? '' }}</td>--}}
{{--                                    <td>{{ $admissionStudent->s_email ?? '' }}</td>--}}
{{--                                    <td>{{ $admissionStudent->moneyReceipt->total_fee ?? '' }}Tk.</td>--}}
{{--                                    <td>{{ $admissionStudent->moneyReceipt->advance ?? '' }}Tk.</td>--}}
{{--                                    <td>{{ $admissionStudent->moneyReceipt->due ?? '' }}Tk.</td>--}}
{{--                                </tr>--}}
{{--                                @php--}}
{{--                                    $sum += $admissionStudent->moneyReceipt->advance--}}
{{--                                @endphp--}}
{{--                            @endforeach--}}
{{--                            <tr>--}}
{{--                                <td colspan="8"></td>--}}
{{--                                <td>--}}
{{--                                    <span style="font-weight: bold">Total Amount : {{ number_format($sum,2) }}</span>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                            @endif--}}

                            @if(isset($admissionStudentsDateFiltering))
                                <tbody>
                                @php
                                    $sum = 0;
                                    $web = 0;
                                    $adm = 0
                                @endphp
                                @foreach($admissionStudentsDateFiltering as $admissionStudentFilter)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $admissionStudentFilter->admission_date->format('Y-m-d') }}</td>
                                        <td>{{ $admissionStudentFilter->admissionForm->user->full_name?? '' }}</td>
                                        <td>
                                            @if($admissionStudentFilter->admissionForm ? $admissionStudentFilter->admissionForm->course == 'web' : '')
                                                Full stack web development
                                            @elseif($admissionStudentFilter->admissionForm ? $admissionStudentFilter->admissionForm->course == 'digital' : '')
                                                Advanced digital marketing
                                            @else
                                                Communication english
                                            @endif
                                        </td>
                                        <td>{{ $admissionStudentFilter->admissionForm->batch_no?? '' }}</td>
                                        <td>{{ $admissionStudentFilter->admissionForm->s_name?? '' }}</td>
                                        <td>{{ $admissionStudentFilter->admissionForm->s_phone ?? '' }}</td>
                                        <td>{{ $admissionStudentFilter->admissionForm->s_email ?? '' }}</td>
                                        <td>{{ $admissionStudentFilter->total_fee ?? '' }}Tk.</td>
                                        <td>{{ $admissionStudentFilter->advance ?? '' }}Tk.</td>
                                        <td>{{ $admissionStudentFilter->due ?? '' }}Tk.</td>
                                    </tr>
                                    @php
                                        if($admissionStudentFilter->admissionForm ? $admissionStudentFilter->admissionForm->course == 'web' : ''){
                                            $web += count(array($admissionStudentFilter->admissionForm->course));
                                        }
                                        if($admissionStudentFilter->admissionForm ? $admissionStudentFilter->admissionForm->course == 'digital' : ''){
                                            $adm += count(array($admissionStudentFilter->admissionForm->course));
                                        }
                                        $sum += $admissionStudentFilter->advance;
                                    @endphp
                                @endforeach
                                <tr>
                                    <td colspan="6"></td>
                                    <td>
                                        <span style="font-weight: bold">Total Amount : {{ number_format($sum,2) }}</span>
                                    </td>
                                    <td>
                                        <span style="font-weight: bold">Total Web Admission : {{ $web }}</span>
                                    </td>
                                    <td>
                                        <span style="font-weight: bold">Total ADM Admission : {{ $adm }}</span>
                                    </td>
                                </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
