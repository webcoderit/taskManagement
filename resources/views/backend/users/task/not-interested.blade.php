@extends("backend.admin.master")

@section('content')
<div class="wrapper">
    <div class="page-wrapper" style="margin-left: 20px!important;">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Not Interested</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/employee/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <!-- <li class="breadcrumb-item active" aria-current="page">
                                <a href="#">List Task</a>
                            </li>  -->
                            <li class="breadcrumb-item active" aria-current="page">Not Interested</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Not Interested</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th width="15%">Email</th>
                                <th>Phone</th>
                                <th>Profession</th>
                                <th width="25%">Note</th>
                                <th width="5%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($notInterested as $data )
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $data->task->name ?? '' }}</td>
                                        <td>{{ $data->task->email ?? '' }}</td>
                                        <td>{{ $data->task->phone ?? '' }}</td>
                                        <td>{{ $data->task->profession ?? '' }}</td>
                                        <td>{{ $data->note ?? '' }}</td>
                                        <td width="5%">
                                            <a href="{{ url('/update/information/'.$data->id) }}" class="btn btn-sm btn-primary" title="Update information">
                                                <i class="bx bx-edit-alt"></i>
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
