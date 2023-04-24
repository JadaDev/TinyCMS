@extends('themes.default.layout.app')

@section('content')
    <h1>Home</h1>
    <p>Home page</p>

    @if (Auth::guard('account')->check())
        <p>Logged in as {{ Auth::guard('account')->user()->username }}</p>
        <p>User ID: {{ Auth::guard('account')->user()->id }}</p>
        get current user secuityLevel 
        <p>Security Level: {{ $account_access }}</p>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
        @endif


@endsection