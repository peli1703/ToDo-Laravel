<!DOCTYPE html>
<html>
	<head>
		<title>My Website</title>
		
		<link rel="stylesheet" type="text/css" href="slide navbar style.css">
		<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="{{asset('css/app.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">	
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	</head>
	<body class="">
		<div class="row">
			@if (Auth::check())
				<div class="nav">
					<nav class="navbar w-100 text-center">
						<p style="color:white; padding-top:20px;">{{Auth::user()->name}}</p><br>
						<a class="btn btn-outline-light" type="submit" href="{{ route('logout') }}">Logout</a>
					</nav>	
			@endif
		</div>

		<div class="col-12 d-flex justify-content-center">
			@yield('content')
		</div>

	</body>
</html>