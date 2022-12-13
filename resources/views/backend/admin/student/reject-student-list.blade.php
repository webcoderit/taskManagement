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
                    <div class="breadcrumb-title pe-3">Reject Student List</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Reject Student List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-success float-right" href="{{ url('/admin/reject/student/list/download') }}">Excel Download</a>
                        <div class="table-responsive">
                            <table id="" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Marketing Officer Name</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Student FB ID</th>
                                    <th>Course Name</th>
                                    <th>Batch No</th>
                                    <th>Course Fee</th>
                                    <th>First Payment</th>
                                    <th>Second Payment</th>
                                    <th>Due</th>
                                    <th>Due Opinion</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rejectStudentLists as $rejectStudentList)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $rejectStudentList->user->full_name ?? session()->get('name') }}</td>
                                        <td>{{ $rejectStudentList->s_name?? '' }}</td>
                                        <td>{{ $rejectStudentList->s_phone ?? '' }}</td>
                                        <td>
                                            <a href="{{ $rejectStudentList->fb_id ?? '' }}" target="_blank">{{ $rejectStudentList->fb_id ?? '' }}</a>
                                        </td>
                                        <td>
                                            @if($rejectStudentList->course == 'web')
                                                Web
                                            @elseif($rejectStudentList->course == 'digital')
                                                ADM
                                            @elseif($rejectStudentList->course == 'attachment_web')
                                                Industrial Attachment ( Web )
                                            @elseif($rejectStudentList->course == 'attachment_adm')
                                                Industrial Attachment ( Adm )
                                            @else
                                                Eng
                                            @endif
                                        </td>
                                        <td>{{ $rejectStudentList->batch_no ?? '' }}</td>
                                        <td>{{ $rejectStudentList->moneyReceipt->total_fee ?? '' }}Tk.</td>
                                        <td>{{ $rejectStudentList->moneyReceipt->advance ?? '' }}Tk.</td>
                                        <td>{{ $rejectStudentList->moneyReceipt->today_pay ?? 'Not yet' }}</td>
                                        <td>{{ $rejectStudentList->moneyReceipt->due ?? '' }}Tk.</td>
                                        <td>{{ $rejectStudentList->note ?? '' }}</td>
                                        <td>
                                            @if($rejectStudentList->is_reject == 1)
                                                <a href="{{ url('/admin/students/restore/'.$rejectStudentList->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="bx bx-refresh"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $rejectStudentLists->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection
