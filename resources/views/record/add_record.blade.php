@extends('layouts.main_with_form')
@section('content')
	@isset($error)
			<div class="error">
				{{ $error }}
			</div>
		@endisset
	<form action="/record" method="post">
		@csrf
		<label for="title">Title:</label>
		<input type="text" name="title" required>

		@error('title')
			<div class="error">{{ $message }}</div>
		@enderror

		<label for="text">Text:</label>
		<input type="text" name="text" required>
		@error('text')
			<div class="error">{{ $message }}</div>
		@enderror

		<input type="submit" value="Submit">
	</form>
@endsection