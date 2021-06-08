<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'user_id',
        'quantity',
    ];

    public function item()
    {
        return $this->belongsTo('\App\Models\Item', 'item_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('\App\Models\User', 'user_id', 'id');
    }

}
