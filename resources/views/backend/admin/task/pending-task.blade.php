@extends('backend.admin.admin-master')

@section('content')
<div class="wrapper">
    <div class="page-wrapper" style="margin-left: 20px!important;">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Pending Task</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Pending Task</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Pending Task</h6>
            <hr/>
            <div class="search-wrapper"></div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form class="form-group" action="" method="">
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
                                        <select name="employee_name" id="employee_name" class="form-control">
                                            <option selected disabled>--- Select Employee ---</option>
                                            <option value="saidul">Saidul Islam</option>
                                            <option value="shahariar">Shahariar Ikbal</option>
                                            <option value="farid">Shak Farid</option>
                                            <option value="utso">Utsho</option>
                                            <option value="shibly">Shibly</option>
                                            <option value="masum">Masum</option>
                                            <option value="rakib">Rakib</option>
                                            <option value="saki">Al Amin Saki</option>
                                            <option value="rony">Rony</option>
                                            <option value="limon">Limon</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="input-group" style="margin-top: 25px;">
                                            <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
                                            <a href="#" class="input-group-text btn btn-danger" id="basic-addon2">Clear</a>
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
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Employee name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pendingTasks as $key => $userName)
                                <tr>
                                    <td>{{ $loop->index+1}}</td>
                                    <td>{{ $userName[0]->user->full_name ?? 'No employee name' }}</td>
                                    <td width="10%">
                                        <a href="{{ url('/admin/user/task/view/'.$userName[0]->user->id) }}" class="btn btn-sm btn-primary">
                                            View all
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
