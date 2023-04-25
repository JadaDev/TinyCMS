@extends('themes.default.layout.app')

@section('content')
@if($errors->any())
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
@endif

<form action="/changepassword/store" method="POST">
    @csrf
    <input type="password" name="oldPassword" placeholder="Old Password">
    <input type="password" name="new_password" placeholder="Password">
    <input type="password" name="password_confirmation" placeholder="Confirm Password">
    <!-- Temporary hidden input for testing -->
    <input type="hidden" name="test_value" value="test">
    <button type="submit">Change Password</button>
</form>
@endsection