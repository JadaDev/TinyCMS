<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authentication;


class Account extends Authentication
{
    use HasFactory;

    protected $connection = 'tc_auth';
    protected $table = 'account';
    public $timestamps = false;
    protected $fillable = ['username', 'email', 'password', 'salt', 'verifier'];

    public function calculate_verifier($username, $password, $salt)
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

    public static function register($payload)
    {
        $salt = random_bytes(32);
        $account = new Account();
        $verifier = $account->calculate_verifier($payload['username'], $payload['password'], $salt);

        $account = new Account();
        $account->username = $payload['username'];
        $account->salt = $salt;
        $account->verifier = $verifier;
        $account->email = $payload['email'];
        $account->save();
    }

    public static function login($payload)
    {
        $account = Account::where('username', $payload['username'])->first();
        if ($account) {
            $verifier = $account->calculate_verifier($payload['username'], $payload['password'], $account->salt);
            if ($verifier == $account->verifier) {
                auth()->guard('account')->login($account);
                return $account;
                redirect('/');
            }
        }
        return false;
    }


    public static function changePassword($payload)
    {
        $user = Account::where('username', $payload['username'])->first();
        if ($user) {
            $verifier = $user->calculate_verifier($user->username, $payload['oldPassword'], $user->salt);
            //DD($verifier);
            if ($verifier == $user->verifier) {
                $salt = random_bytes(32);
                $verifier = $user->calculate_verifier($user->username, $payload['new_password'], $salt);
                $user->salt = $salt;
                $user->verifier = $verifier;
                $user->save();
                return $user;
            }
        }
        return false;
    }
}
