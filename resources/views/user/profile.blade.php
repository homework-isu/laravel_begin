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
@endsection