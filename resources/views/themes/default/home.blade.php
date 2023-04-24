@extends('themes.default.layout.app')

@section('content')
    <h1>Home</h1>
    <p>Home page</p>

        <form action="/logout" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>


@endsection