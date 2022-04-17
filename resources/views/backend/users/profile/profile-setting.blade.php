@extends('backend.admin.master')

@section('content')
<section class="profile-setting-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 m-auto">
				<h4 class="profile-setting-section-title">
					Profile Setting
				</h4>
				<div class="profile-setting-outer card p-4">					
					<div class="row">
						<div class="col-md-6 border-right">
							<div class="general-setting-outer">
								<h4 class="general-setting-form-title">
									General Information
								</h4>
								<form class="general-setting-form form-group">
									<label for="fname">Frist Name</label><br>
									<input type="text" name="fname" class="form-control" placeholder="Frist Name">
									<label for="lname">Last Name</label><br>
									<input type="text" name="lname" class="form-control" placeholder="Last Name">
									<label for="lname">Email</label><br>
									<input type="email" name="email" class="form-control" placeholder="Email">
									<label for="lname">Phone</label><br>
									<input type="number" name="number" class="form-control" placeholder="Phone Number">
									<div class="avatar-upload">
				                        <div class="avatar-edit">
				                            <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" />
				                            <label for="imageUpload"></label>
				                        </div>
				                        <div class="avatar-preview">
				                            <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);">
				                            </div>
				                        </div>
				                    </div>
				                    <div class="general-setting-form-btn-outer">
				                    	<button type="button" class="btn btn-primary">
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
								<form class="general-setting-form form-group">
									<label for="fname">Old Password</label><br>
									<input type="password" name="" class="form-control" placeholder="Old Password">
									<label for="lname">New Password</label><br>
									<input type="password" name="" class="form-control" placeholder="New Password">
									<label for="lname">Confirm Password</label><br>
									<input type="password" name="" class="form-control" placeholder="Confirm Password">
									<div class="password-setting-form-btn-outer">
										<button type="button" class="btn btn-primary">
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
