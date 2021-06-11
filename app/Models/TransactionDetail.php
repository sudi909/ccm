<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $table = 'detail_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id',
        'item_id',
        'quantity',
        'price',
        'total',
    ];

    public function transaction()
    {
        return $this->belongsTo('\App\Models\Transaction', 'transaction_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo('\App\Models\Item', 'item_id', 'id');
    }
}
