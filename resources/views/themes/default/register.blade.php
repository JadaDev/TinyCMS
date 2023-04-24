@extends('themes.default.layout.app')

@section('content')
    <h1>Home</h1>
    <p>This is the register page</p>

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
            <input type="text" name="name" id="name" placeholder="Name">
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