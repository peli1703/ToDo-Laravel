@extends('layout')
@section('content')
@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">
		@if (Session::get('succes'))
				<div class="alert alert-success w-100">
				{{ Session::get('succes') }}
			</div>
		@endif
		@if (Session::get('fail'))
				<div class="alert alert-danger w-100">
				{{ Session::get('fail') }}
			</div>
		@endif

		@if (Session::get('notAllowed'))
			<div class="alert alert-danger w-100">
				{{ Session::get('notAllowed') }}
			</div>
		@endif
		
			<div class="signup">
				<form  method="POST" action="/register">
				@csrf
				<label for="chk" aria-hidden="true">Sign up</label>
				<input type="email" name="email" placeholder="Email">
				<input type="name" name="name" placeholder="Name">
				<input type="username" name="username" placeholder="User name">
				<input type="password" name="password" placeholder="Password">
				<button type="submit">Sign up</button>
				</form>
			</div>

			<div class="login">
				<form method="POST" action="{{route('loginauth')}}">
					@csrf
					<label for="chk" aria-hidden="true">Login</label>
					<input type="username" name="username" placeholder="User name">
					<input type="password" name="password" placeholder="Password">
					<button type="submit">Login</button>
				</form>
			</div>
	</div>
@endsection
	