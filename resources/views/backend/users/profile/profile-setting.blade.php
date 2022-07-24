@extends('backend.admin.master')

@section('content')
<section class="profile-setting-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 m-auto">
				<h4 class="profile-setting-section-title">
					Profile Setting
				</h4>
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ Session::get('success') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ Session::get('error') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
				<div class="profile-setting-outer card p-4">
					<div class="row">
						<div class="col-md-6 border-right">
							<div class="general-setting-outer">
								<h4 class="general-setting-form-title">
									General Information
								</h4>
								<form class="general-setting-form form-group" action="{{ url('/profile/update/'.auth()->user()->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
									<label for="first_name">Frist Name</label><br>
									<input type="text" name="first_name" value="{{ auth()->user()->first_name ?? '' }}" class="form-control" placeholder="Dirst Name">
									<label for="last_name">Last Name</label><br>
									<input type="text" name="last_name" value="{{ auth()->user()->last_name ?? '' }}" class="form-control" placeholder="Last Name">
									<label for="email">Email</label><br>
									<input type="email" name="email" readonly value="{{ auth()->user()->email ?? '' }}" class="form-control" placeholder="Email">
									<label for="phone">Phone</label><br>
									<input type="tel" name="phone" value="{{ auth()->user()->phone ?? '' }}" class="form-control" placeholder="Phone Number">
									<div class="avatar-upload">
				                        <div class="avatar-edit">
				                            <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" onchange="imagePreview(event)" />
				                            <label for="imageUpload"></label>
				                        </div>
				                        <div class="avatar-preview">
				                            <div>
                                                <img src="{{ asset('/avatar/'.auth()->user()->avatar) }}" style="height: 200px; width: 220px;" id="pre-avatar">
                                            </div>
				                        </div>
				                    </div>
				                    <div class="general-setting-form-btn-outer">
				                    	<button type="submit" class="btn btn-primary">
				                    		Submit
				                    	</button>
				                    </div>
								</form>
							</div>
						</div>
						<div class="col-md-6">
							<div class="general-setting-outer">
								<h4 class="password-setting-form-title">
									Password
								</h4>
								<form class="general-setting-form form-group" action="{{ url('/password/update/'.auth()->user()->id) }}" method="post">
                                    @csrf
									<label for="old_password">Old Password</label><br>
                                    <span style="color: red"> {{ $errors->has('old_password') ? $errors->first('old_password') : ' ' }}</span>
									<input type="password" name="old_password" class="form-control" placeholder="Old Password">
									<label for="new_password">New Password</label><br>
                                    <span style="color: red"> {{ $errors->has('password') ? $errors->first('password') : ' ' }}</span>
									<input type="password" name="password" class="form-control" placeholder="New Password">
									<label for="password_confirmation">Confirm Password</label><br>
                                    <span style="color: red"> {{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : ' ' }}</span>
									<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
									<div class="password-setting-form-btn-outer">
										<button type="submit" class="btn btn-primary">
											Submit
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
