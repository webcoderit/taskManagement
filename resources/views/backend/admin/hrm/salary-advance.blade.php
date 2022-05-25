@extends('backend.admin.hr-master')

@section('content')
<section class="student-due-edit-section" style="padding: 1.5rem;margin-left: 20px;">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Accounts</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/hr/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Advance</li>
                </ol>
            </nav>
        </div>
    </div>
    <h6 class="mb-0 text-uppercase">Salary Advance</h6>
    <hr/>
<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="student-due-edit-wrapper" style="margin-top: 40px;padding: 20px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                <div class="foem-header-wpapper">
                    <div>
                        <h6 class="mb-0 text-uppercase">Salary Advance</h6>
                    </div>
                    <div>
                        <a href="{{ url('/salary') }}" class="back-btn-inner">
                            <i class="bx bx-arrow-to-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <hr>
                <form class="student-due-edit-form form-group">
                    <label for="month" style="font-weight: 600;margin-bottom: 10px;">Select Month</label><br>
                    <select name="month" id="month" class="form-control" style="margin-bottom: 20px;">
                        <option selected disabled>--- Select Month ---</option>
                        <option value="january">January</option>
                        <option value="february">February</option>
                        <option value="march">March</option>
                        <option value="april">April</option>
                        <option value="may">May</option>
                        <option value="june">June</option>
                        <option value="july">July</option>
                        <option value="august">August</option>
                        <option value="september">September</option>
                        <option value="october">October</option>
                        <option value="november">November</option>
                        <option value="december">December</option>
                    </select>
                    <label style="font-weight: 600;margin-bottom: 10px;">Advance</label><br>
                    <input type="number" name="advance" placeholder="advance" class="form-control">
                    </select>
                    <label style="font-weight: 600;margin-bottom: 10px;">Note</label><br>
                    <textarea class="form-control" name="note" rows="5" placeholder="Note here..."></textarea>
                    <div style="text-align: center;margin-top: 20px;">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
