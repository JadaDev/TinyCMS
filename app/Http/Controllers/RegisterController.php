<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Register;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;



class registerController extends Controller
{
    public function index()
    {
        return view('themes.default.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3',
            'password_confirmation' => 'required|same:password'
        ]);


        $salt = random_bytes(32);
        $register = new Register();
        $verifier = $register->calculate_verifier($request->get('name'), $request->get('password'), $salt);

        $register = new Register([
            'username' => $request->get('name'),
            'email' => $request->get('email'),
            'salt' => $salt,
            'verifier' => $verifier
        ]);

        try {
            $register->save();
            return redirect('/')->with('success', 'Account created successfully!');
        } catch (\Exception $e) {
            return redirect('/register')->with('error', 'Something went wrong!');
        }
    }
}
