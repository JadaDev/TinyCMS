<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class passwordController extends Controller
{
    public function index()
    {
        return view('themes.default.changepassword');
    }

    public function changepassword(Request $request)
    {
         $request->validate([
            'oldPassword' => 'required',
            'new_password' => 'required',
            'password_confirmation' => 'required|same:new_password',
        ]);

        $payload = [
            'username' => auth()->guard('account')->user()->username,
            'oldPassword' => $request->input('oldPassword'),
            'new_password' => $request->input('new_password'),
        ];
        $password = Account::changePassword($payload);
    }

}
