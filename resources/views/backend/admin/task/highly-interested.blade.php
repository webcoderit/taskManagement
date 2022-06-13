@extends("backend.admin.admin-master")

@section('content')
<div class="wrapper">
    <div class="page-wrapper" style="margin-left: 20px!important;">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Highly Interested</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">
                                <a href="#">List Task</a>
                            </li> --}}
                            <li class="breadcrumb-item active" aria-current="page">Highly Interested</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Highly Interested</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form class="form-group" action="{{ url('/admin/user/highly/interested') }}" method="get">
                            @csrf
                            <div class="col-md-12" style="padding-left: 10%;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label style="font-weight: 600;margin-bottom: 5px;">
                                            Select Month
                                        </label><br>
                                        <input type="month" name="month" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label style="font-weight: 600;margin-bottom: 5px;">
                                            Select Employee Name
                                        </label><br>
                                        <select name="user_id" id="user_id" class="form-control">
                                            <option selected disabled>--- Select Employee ---</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group" style="margin-top: 25px;">
                                            <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
                                            <a href="{{ url('/admin/user/highly/interested') }}" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="text-align-last: end;">
                                       <a href="#" class="download-btn">
                                            <i class="fa fa-cloud-download"></i>
                                            Download Pdf
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Employee Name</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Note</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($highlyInterested as $data)
                                    <tr>
                                        <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                        <td>{{ $data->task->user->full_name ?? '' }}</td>
                                        <td>{{ $data->task->name ?? '' }}</td>
                                        <td>{{ $data->task->email ?? '' }}</td>
                                        <td>{{ $data->task->phone ?? '' }}</td>
                                        <td>{{ $data->note ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $highlyInterested->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
