<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'code',
        'date',
        'customer_name',
        'address',
        'phone_number',
        'status',
        'grand_total',
        'payment_date',
        'payment_path',
    ];
}
