<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eth_account extends Model
{
    public $table = 'eth_account';

    use HasFactory;
    protected $fillable = [
        'user_id',
        'keystore'
    ];

    protected $hidden = [
        'keystore',
    ];
    
}
