<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Log;


class registerController extends Controller
{
    public function index()
    {
        return view('themes.default.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|unique:tc_auth.account,username',
            'email' => 'required|email|unique:tc_auth.account,email',
            'password' => 'required|min:3',
            'password_confirmation' => 'required|same:password'
        ]);

        $payload = new Account([
            'username' => $request->get('username'),
            'password' => $request->get('password'),
            'email' => $request->get('email'),
        ]);
        try{
            $account = Account::register($payload);
;
        } catch(\Exception $e){
            log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong, please try again!');
        }
        return redirect()->route('login.index')->with('success', 'Account created successfully!');
    }
}
