<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account_access extends Model
{
    use HasFactory;
    protected $connection = 'tc_auth';
    protected $table = 'account_access';

    public function account()
    {
        return $this->belongsTo(account::class, 'id', 'id');
    }

}
