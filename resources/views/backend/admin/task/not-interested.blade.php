@extends('backend.admin.admin-master')

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
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">
                                <a href="#">List Task</a>
                            </li> --}}
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
                    <div class="row">
                        <form class="form-group" action="" method="">
                            @csrf
                            <div class="col-md-8 m-auto">
                                <div class="row">
                                    <div class="col-md-8">
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Profession</th>
                                <th>Note</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($notInterested as $data)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $data->task->name ?? '' }}</td>
                                        <td>{{ $data->task->email ?? '' }}</td>
                                        <td>{{ $data->task->phone ?? '' }}</td>
                                        <td>{{ $data->task->profession ?? '' }}</td>
                                        <td>{{ $data->note ?? '' }}</td>
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
