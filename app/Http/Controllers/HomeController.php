<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account_Access;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function index()
    {
        $loggedInUserId = Auth::guard('account')->user()->id;
        $account_access = Account_Access::all();    
        return view('themes.default.home', compact('account_access'));
    }
}
