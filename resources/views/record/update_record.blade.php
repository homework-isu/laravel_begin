@extends('layouts.main_with_form')
@section('content')
	@isset($error)
			<div class="error">
				{{ $error }}
			</div>
		@endisset
	<form action="{{ route('record.update') }}" method="post">
		@csrf
		@method('PUT')
		<label for="title">Title:</label>
		<input type="text" name="title" required value="{{ $record['title'] }}">

		@error('title')
			<div class="error">{{ $message }}</div>
		@enderror

		<label for="text">Text:</label>
		<textarea name="text" required>{{ $record['text'] }}</textarea>
		@error('text')
			<div class="error">{{ $message }}</div>
		@enderror

		<input type="submit" value="Submit">
	</form>
@endsection