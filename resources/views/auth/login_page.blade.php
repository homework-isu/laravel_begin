@extends('layouts.main_with_form')
@section('content')
	<h1>Login</h1>
	<form action="/login" method="post">
		
		@error('summary')
			<div class="error">{{ $message }}</div>
		@enderror
		
		@csrf
		<label for="username">Username:</label>
		<input type="text" name="username" required>

		@error('username')
			<div class="error">{{ $message }}</div>
		@enderror

		<label for="password">Password:</label>
		<input type="password" name="password">

		@error('password')
			<div class="error">{{ $message }}</div>
		@enderror

		<input type="submit" value="Submit">
	</form>
	<a href="/register">
		Зарегестрироваться
	</a>
@endsection