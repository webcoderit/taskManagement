<!doctype html>
<html lang="en" class="semi-dark">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	@include('backend.includes.style')
    @stack('style')
    <style>
        .custom-green-badge{
            margin-left: 20px;
            text-align: center;
            background-color: green;
            padding: 5px;
            color: white;
            font-weight: 500;
            border-radius: 3px;
        }

        .custom-red-badge{
            margin-left: 20px;
            text-align: center;
            background-color: red;
            padding: 5px;
            color: white;
            font-weight: 500;
            border-radius: 3px;
        }
        .user-online-offline-b {
            position: relative;
        }
        .user-online-offline-c {
            position: relative;
        }
        .user-online-offline-b:after {
            content: '';position: absolute;
            background: #07c107;
            height: 12px;
            width: 12px;
            left: 26px;
            bottom: 7px;
            border-radius: 100%;
            border: 1px solid#fff;
        }
        .user-online-offline-c:after {
            content: '';position: absolute;
            background: red;
            height: 12px;
            width: 12px;
            left: 26px;
            bottom: 7px;
            border-radius: 100%;
            border: 1px solid#fff;
        }
    </style>
	<title>Admin dashboard</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		@include('backend.includes.admin-nav')
		<!--end sidebar wrapper -->
		<!--start header -->
		@include('backend.includes.admin-header')
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			@yield('content')
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="search-overlay"></div>
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright © {{ date('Y')  }}. All right reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->
	<!--start switcher-->

	<!--end switcher-->
	<!-- Bootstrap JS -->
	@include('backend.includes.script')
    @stack('script')
    <script>
        function imagePreview(e){
            if (e.target.files[0]) {
                let image = e.target.files[0];
                if(image['type'] === 'image/jpeg' || image['type'] === 'image/png' || image['type'] === 'image/webp' || image['type'] === 'image/gif'){
                    let reader = new FileReader();
                    reader.onload = function ()
                    {
                        let output = document.getElementById('pre-avatar');
                        output.src = reader.result;
                        output.style.display = "block";
                        output.style.width = "10%";
                    }
                    reader.readAsDataURL(event.target.files[0]);
                }else{
                    alert('This is not image file. Please input e valid image.');
                }
            }
        }
    </script>
</body>

</html>
