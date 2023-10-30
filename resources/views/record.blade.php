@extends('layouts.main_with_records')
@section('content')
	@include('partials.record', ['record' => $record])
@endsection