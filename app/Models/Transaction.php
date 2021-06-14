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
        'resi',
        'province',
        'city',
        'status',
        'shipping',
        'shipping_price',
        'total_price',
        'grand_total',
        'payment_date',
        'payment_path',
    ];

    public function details()
    {
        return $this->hasMany('\App\Models\TransactionDetail', 'transaction_id', 'id');
    }
}
