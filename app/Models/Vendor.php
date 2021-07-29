<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;

class Vendor extends Authenticable
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'franchise',
        'email',
        'password',
    ];
}
