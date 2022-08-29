@extends('backend.admin.hr-master')

@section('content')
	<section class="add-espanse-section" style="padding: 1.5rem;margin-left: 20px;">
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
        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h6 class="mb-0 text-uppercase">Add Expanse</h6>
        <hr/>
		<div class="container">
			<div class="row">
				<div class="col-md-6 m-auto">
					<div class="add-expanse-wrapper" style="margin-top: 40px;padding: 20px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
						<div style="text-align: end;">
							<a href="{{ url('/expanse') }}" class="back-btn-inner">
								<i class="bx bx-arrow-to-left"></i>
								Back
							</a>
						</div>
						<hr>
						<form class="add-expanse-form form-group" action="{{ url('/add/new/expanse') }}" method="post">
                            @csrf
                            <label style="font-weight: 600;margin-bottom: 5px;">Select A User</label><br>
                            <select name="user_id" id="user_id" class="form-control">
                                <option selected disabled>--- Select A User ---</option>
                                @foreach(\App\Models\User::all() as $user)
                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                @endforeach
                            </select><br>
                            <label style="font-weight: 600;margin-bottom: 5px;">Select Bill Type*</label><br>
                            <select name="bill_type" id="bill_type" class="form-control" onchange="mobileBill(this.value)">
                            	<option selected disabled>--- Select Bill Type ---</option>
                            	<option value="mobile">Mobile Bill</option>
                            	<option value="net">Net Bill</option>
                            	<option value="electricity">Electricity Bill</option>
                            	<option value="food">Food</option>
                            	<option value="others">Others Bill</option>
                            </select><br>
                            <div id="minute">
                                <label style="font-weight: 600;margin-bottom: 5px;">Mobile Minute</label><br>
                                <input type="text" name="minute" placeholder="Total minute" class="form-control"><br>
                            </div>
							<label style="font-weight: 600;margin-bottom: 5px;">Price*</label><br>
							<input type="number" name="price" placeholder="Total Fee" class="form-control"><br>
							<label style="font-weight: 600;margin-bottom: 5px;">Note*</label><br>
							<textarea class="form-control" rows="4" name="note" cols="20"></textarea>
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

@push('script')
    <script>
        $('#minute').hide();
        function mobileBill(e){
            if( e == 'mobile'){
                $('#minute').show();
            }
            else{
                $('#minute').hide();
            }
        }
    </script>
@endpush
