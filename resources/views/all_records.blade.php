@extends('layouts.main_with_records')
@section('content')

	@foreach ($records as $record)
		@include('partials.record', ['record' => $record])
	@endforeach
@endsection