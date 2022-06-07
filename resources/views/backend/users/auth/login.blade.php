
<!doctype html>
<html lang="en">

<head>
    <title>User Login</title>
    <link rel="stylesheet" href="{{ asset('/backend/assets/css/login.css') }}">
</head>

<body class="bg-login">
<!--wrapper-->
<form class="box" method="POST" action="{{ route('login') }}">
    @csrf
    <h1>Login</h1>
    <input type="text" name="email" placeholder="Email address" class="@error('email') is-invalid @enderror">
    @error('email')
    <span class="invalid-feedback" role="alert" style="color: red">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <input type="password" name="password" placeholder="Password" class="@error('password') is-invalid @enderror">
    @error('password')
    <span class="invalid-feedback" role="alert" style="color: red">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <button type="submit">Login</button>
</form>

<div class="lines">
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
</div>
<!--end wrapper-->
</body>

</html>
