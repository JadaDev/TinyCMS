<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Account;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

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

        $payload = new Account([
            'username' => $request->get('name'),
            'password' => $request->get('password'),
            'email' => $request->get('email'),
        ]);
        $account = Account::register($payload);
    }
}
