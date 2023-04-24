<?php

namespace App\Http\Controllers;

use App\Models\login;
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

    private function CalculateSRP6Verifier($username, $password, $salt)
    {
        $g = gmp_init(7);
        $N = gmp_init('894B645E89E1535BBDAD5B8B290650530801B18EBFBF5E8FAB3C82872A3E9BB7', 16);
        $h1 = sha1(strtoupper($username . ':' . $password), TRUE);
        $h2 = sha1($salt.$h1, TRUE);
        $h2 = gmp_import($h2, 1, GMP_LSW_FIRST);
        $verifier = gmp_powm($g, $h2, $N);
        $verifier = gmp_export($verifier, 1, GMP_LSW_FIRST);
        $verifier = str_pad($verifier, 32, chr(0), STR_PAD_RIGHT);
        return $verifier;
    }

    public function login(Request $request)
    {
        $account = Account::where('username', strtoupper($request->input('username')))->first();
        $checkVerifier = $this->CalculateSRP6Verifier($request->input('username'), $request->input('password'), $account->salt);
        if(($account->verifier === $checkVerifier))
        {
            Auth()->guard('account')->login($account);
            return redirect('/');
        }
        abort(401);
    }

    public function logout()
    {
        auth()->guard('account')->logout();
        return redirect('/login');
  
    }

}
