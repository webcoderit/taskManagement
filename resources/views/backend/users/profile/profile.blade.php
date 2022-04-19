@extends('backend.admin.master')

@section('content')
<section class="profile-section-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-6 m-auto">
				<div class="user-profile-outer card p-4">
					<div class="user-profile-image-outer">
						<img src="{{ asset('backend/') }}/assets/images/user-profile.jpg" class="user-profile-image">						
					</div>
					<div class="user-profile-info-inner">
						<h4 class="user-profile-name">
							Saidul Islam
						</h4>					
						<span class="user-profile-email">saidulisalmjihad@gmail.com</span><br>
						<span class="user-profile-number">0123456789</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
