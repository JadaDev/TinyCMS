@extends('themes.default.layout.app')

@section('content')
    <h1>Login</h1>

    <form action="/login" method="POST">
        @csrf
        <div>
            <input type="text" name="username" id="username" placeholder="username">
        </div>
        <div>
            <input type="password" name="password" id="password" placeholder="password">
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
@endsection