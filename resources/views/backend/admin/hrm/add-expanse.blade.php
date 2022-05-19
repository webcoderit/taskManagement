@extends('backend.admin.hr-master')

@section('content')
	<section class="add-espanse-section">
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Expanse</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/hr/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Expanse</li>
                    </ol>
                </nav>
            </div>
        </div>
        <h6 class="mb-0 text-uppercase">Add Expanse</h6>
        <hr/>
		<div class="container">
			<div class="row">
				<div class="col-md-6 m-auto">
					<div class="add-expanse-wrapper" style="margin-top: 40px;padding: 20px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
						<form class="add-expanse-form form-group">
							<label style="font-weight: 600;">Price</label><br>
							<input type="number" name="total_fee" placeholder="Total Fee" class="form-control">
							<label style="font-weight: 600;">Note</label><br>
							<textarea class="form-control" rows="4" cols="20"></textarea>
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
