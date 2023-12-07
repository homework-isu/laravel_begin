@extends('layouts.main_with_records')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Profile</div>

                    <div class="card-body">
                        <p>ID: {{ $user->id }}</p>
                        <p>Username: {{ $user->username }}</p>
                        <p>Name: {{ $user->name }}</p>
                        <p>Surname: {{ $user->surname }}</p>

                        <!-- Другая информация о пользователе по необходимости -->

                        <a href="{{ url('/logout') }}">logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

	@forelse ($records as $record)
		@include('record.record_with_options_template', ['record' => $record, 'comments' => $comments[$record['id']]])
	@empty
		<h1>Нет доступных записей</h1>
	@endforelse 


@endsection

@section('custom_js')
	<script src="{{ asset('js/show_comments.js') }}"></script>
	<script src="{{ asset('js/load_comments.js') }}"></script>
@endsection