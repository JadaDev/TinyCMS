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
}