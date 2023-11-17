@extends('layouts.main_with_form')
@section('content')
	<form action="/register" method="post">
		@csrf
		<label for="username">Username:</label>
		<input type="text" name="username" required>

		@error('username')
			<div class="error">{{ $message }}</div>
		@enderror

		<label for="name">Name:</label>
		<input type="text" name="name" required>
		
		@error('name')
			<div class="error">{{ $message }}</div>
		@enderror

		<label for="surname">Surname:</label>
		<input type="text" name="surname" required>
		
		@error('surname')
			<div class="error">{{ $message }}</div>
		@enderror

		<label for="password">Password again:</label>
		<input type="password" name="password">
		
		@error('password')
			<div class="error">{{ $message }}</div>
		@enderror

		<label for="password_confirmation">Password:</label>
		<input type="password" name="password_confirmation">
		
		@error('password_confirmation')
			<div class="error">{{ $message }}</div>
		@enderror

		<input type="submit" value="Submit">
	</form>
@endsection