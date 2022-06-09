
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<link href="{{ asset('backend/') }}/assets/css/icons.css" rel="stylesheet">
	<link href="{{ asset('backend/') }}/assets/css/admin-login.css" rel="stylesheet">
	<title>Admin Login</title>
</head>

<body>
	<!--wrapper-->
	<div class="login-box">
	  	<h2>Admin Login</h2>
	  	<form action="{{ route('admin.login') }}" method="post">
	  		@csrf
	    	<div class="box">
	      		<input type="email" name="email" required id="inputEmailAddress">
	      		<label>Email</label>
	      		<span style="color: red"> {{ $errors->has('email') ? $errors->first('email') : ' ' }}</span>
	    	</div>
	    	<div class="box" id="show_hide_password">
	      		<input type="password" name="password" required id="inputChoosePassword" value="12345678">
	      		<label>Password</label>
	      		<a href="javascript:;" class="hide-show-icon"><i class='bx bx-hide'></i></a>
                <span style="color: red"> {{ $errors->has('password') ? $errors->first('password') : ' ' }}</span>
	    	</div>
	    	<button type="submit" class="admin-login-btn"><i class="bx bxs-lock-open"></i>Sign in</button>
	  </form>
	</div>
	<!--end wrapper-->
	<!--plugins-->
	<script src="{{ asset('backend/') }}/assets/js/jquery.min.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="{{ asset('backend/') }}/assets/js/app.js"></script>
</body>

</html>
