@extends('backend.admin.master')

@section('content')
    <div class="wrapper">
        <div class="page-wrapper" style="margin-left: 20px!important;">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Registration</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('admin.user.register.form.create') }}">Add user</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Users</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <h6 class="mb-0 text-uppercase">Employee list</h6>
                <hr/>
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ Session::get('success') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Employment Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $user->full_name ?? 'No name found' }}</td>
                                        <td>{{ $user->email ?? 'No email found' }}</td>
                                        <td>{{ $user->phone ?? 'No phone found' }}</td>
                                        <td>
                                            @if($user->status == 1)
                                                <span class="custom-green-badge">Employed</span>
                                            @else
                                                <span class="custom-red-badge">Terminated</span>
                                            @endif
                                        </td>
                                        <td width="15%">
                                            <a href="{{ url('/admin/user/edit/'.$user->id) }}" class="btn btn-sm btn-primary"><i class="bx bx-edit-alt"></i></a>
                                            @if($user->status == 1)
                                                <a href="{{ url('/admin/user/active/'.$user->id) }}" class="btn btn-sm btn-success"><i class="bx bx-like"></i></a>
                                            @else
                                                <a href="{{ url('/admin/user/inactive/'.$user->id) }}" class="btn btn-sm btn-warning"><i class="bx bx-dislike"></i></a>
                                            @endif
                                            <a href="{{ url('/admin/user/delete/'.$user->id) }}" onclick="return confirm('Are you sure delete this information')" class="btn btn-sm btn-danger"><i class="bx bx-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
