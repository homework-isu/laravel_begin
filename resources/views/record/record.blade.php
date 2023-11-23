@extends('layouts.main_with_records')
@section('content')
	@include('record.record_template', ['record' => $record])
@endsection