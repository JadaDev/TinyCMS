@extends('themes.default.layout.app')

@section('content')
    <h1>Registration</h1>
    <p>This is the Registration page</p>

@if (session('success'))
        {{ session('success') }}
@endif

@if ($errors->any())
<div>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

    <form action="/register/store" method="POST">
        @csrf
        <div>
            <input type="text" name="username" id="username" placeholder="Username">
        </div>
        <div>
            <input type="email" name="email" id="email" placeholder="Email">
        </div>
        <div>
            <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <div>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password Confirm">
        </div>
        <div>
            <button type="submit">Register</button>
        </div>
@endsection