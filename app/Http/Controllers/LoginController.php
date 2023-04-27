<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Foundation\Auth\User as Authentication;
use Illuminate\Support\Facades\Log;

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
            'username' => 'required|string',
            'password' => 'required',
         ]);

         $payload = new Account([
            'username' => $request->get('username'),
            'password' => $request->get('password'),
         ]);

        try{
            $account = Account::login($payload);
            log::info('User Logged In: ' . $account->username);
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Invalid username or password');
        }
        return redirect('/')->with('success', 'Logged in successfully!');
    }

    public function logout()
    {
        auth()->guard('account')->logout();
        return redirect('/');
  
    }

}
