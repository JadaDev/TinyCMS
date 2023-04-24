<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registerModel extends Model
{
    use HasFactory;
    protected $connection = 'tc_auth';
    protected $table = 'account';
    protected $fillable = ['username', 'email', 'password', 'salt', 'verifier'];
    public $timestamps = false;

    
}
