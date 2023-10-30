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

		<label for="content">Content:</label>
		<input type="text" name="content" required>

		<label for="author">Author:</label>
		<input type="text" name="author">

		<input type="submit" value="Submit">
	</form>
@endsection