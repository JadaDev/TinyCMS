<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\registerModel;
use Illuminate\Database\QueryException;


class registerController extends Controller
{
    public function index()
    {
        return view('themes.default.register');
    }

    private function calculate_verifier($username, $password, $salt)
    {
        $g = gmp_init(7);
        $N = gmp_init('894B645E89E1535BBDAD5B8B290650530801B18EBFBF5E8FAB3C82872A3E9BB7', 16);
        $h1 = sha1(strtoupper($username . ':' . $password), TRUE);
        $h2 = sha1($salt . $h1, TRUE);
        $h2 = gmp_import($h2, 1, GMP_LSW_FIRST);
        $verifier = gmp_powm($g, $h2, $N);
        $verifier = gmp_export($verifier, 1, GMP_LSW_FIRST);
        $verifier = str_pad($verifier, 32, chr(0), STR_PAD_RIGHT);
        return $verifier;
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
        $verifier = $this->calculate_verifier($request->get('name'), $request->get('password'), $salt);

        $register = new registerModel([
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
