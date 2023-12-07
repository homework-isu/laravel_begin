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
		<input type="text" name="title" value="{{ old('title') }}" required>

		@error('title')
			<div class="error">{{ $message }}</div>
		@enderror

		<label for="text">Text:</label>
		<textarea name="text" id="text">
			{{ old('text') }}
		</textarea>
		@error('text')
			<div class="error">{{ $message }}</div>
		@enderror

		<div class="line" id="publish_at_time_line">
			<label for="publish_at_time">Опубликовать по времени:</label>
			<input type="checkbox" name="publish_at_time" value=" {{true}} " id="publish_at_time">
		</div>
		<div class="line disabled" id="publisher_time_line">
			<label for="publisher_time">Выберите дату и время:</label>
			<input type="datetime-local" name="publisher_time" value="{{ old('publisher_time') }}" id="publisher_time">
		</div>

		<button type="submit">Создать</button>
	</form>
@endsection

@section('custom_js')
	<script src="{{ asset('js/show_time_picker.js') }}"></script>
@endsection