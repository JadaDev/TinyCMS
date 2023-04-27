@extends('themes.default.layout.app')

@section('content')
    <h1>Home</h1>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    @endif
    @if($account)
        <p>Logged in: {{ $account->username }}</p>
        <p>Account ID: {{ $account->id }}</p>
        <p>Account Email: {{ $account->email }}</p>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <p>Not logged in</p>
        <a href="/login">Login</a>
        <a href="/register">Register</a>
    @endif


@endsection