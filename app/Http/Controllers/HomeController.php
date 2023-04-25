<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account_Access;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function index()
    {  
        $account = auth()->guard('account')->user();
        return view('themes.default.home', compact('account'));
    }
}
