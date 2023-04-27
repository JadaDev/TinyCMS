@extends('themes.default.layout.app')
@section('content')
    <h1>Login</h1>
    <p>This is the Login page</p>

@if(session('success'))
    {{session('success')}}
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
@endif

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