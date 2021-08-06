<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",'user_type',"account_name", "account_number", "sort_code", "bank_name"
    ];
}
