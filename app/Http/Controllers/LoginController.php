<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Foundation\Auth\User as Authentication;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('themes.default.login');
    }

    public function login(Request $request)
    {
         $request->validate([
            'username' => 'required',
            'password' => 'required',
         ]);

         $payload = new Account([
            'username' => $request->get('username'),
            'password' => $request->get('password'),
         ]);
        $account = Account::login($payload);
        
    }

    public function logout()
    {
        auth()->guard('account')->logout();
        return redirect('/login');
  
    }

}
