@extends('themes.default.layout.app')

@section('content')
    <h1>Home</h1>
    @if($account)
        <p>Logged in: {{ $account->username }}</p>
        <p>Account ID: {{ $account->id }}</p>
        <p>Account Email: {{ $account->email }}</p>
    @else
        <p>Not logged in</p>
    @endif

        <form action="/logout" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>


@endsection