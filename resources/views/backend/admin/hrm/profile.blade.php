@extends('backend.admin.hr-master')

@section('content')
<section class="profile-setting-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 m-auto">
				<h4 class="profile-setting-section-title">
					Profile Setting
				</h4>
                @if(Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
                @if(Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
				<div class="profile-setting-outer card p-4">
					<div class="row">
						<div class="col-md-6 border-right">
							<div class="general-setting-outer">
								<h4 class="general-setting-form-title">
									General Information
								</h4>
								<form class="general-setting-form form-group" action="{{ url('/hr/profile/update/'.$hrProfileUpdate->id) }}" method="post">
                                    @csrf
									<label for="name">Name</label><br>
									<input type="text" name="name" class="form-control" value="{{ $hrProfileUpdate->name ?? '' }}" placeholder="Name">
									<label for="email">Email</label><br>
									<input type="email" name="email" class="form-control" value="{{ $hrProfileUpdate->email ?? '' }}" placeholder="Email">
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
								<form class="general-setting-form form-group" action="{{ url('/hr/password/update/'.$hrProfileUpdate->id) }}" method="post">
                                    @csrf
									<label for="old_password">Old Password</label><br>
									<input type="password" name="old_password" class="form-control" placeholder="Old Password">
									<label for="new_password">New Password</label><br>
									<input type="password" name="password" class="form-control" placeholder="New Password">
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
