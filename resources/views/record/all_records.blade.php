@extends('layouts.main_with_records')
@section('content')

	@auth('web')
		@foreach ($records as $record)
			@include('record.record_template_with_comments', ['record' => $record, 'commentable' => true])
		@endforeach
	@endauth

	@guest('web')
		@foreach ($records as $record)
			@include('record.record_template_with_comments', ['record' => $record])
		@endforeach
	@endguest

@endsection

@section('custom_js')
	<script src="{{ asset('js/show_comments.js') }}"></script>
	<script src="{{ asset('js/load_comments.js') }}"></script>
	@include('scripts.submit_comment')
@endsection