<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'weight',
        'stock',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo('\App\Models\Category', 'category_id', 'id');
    }

    public function cart()
    {
        return $this->hasMany('\App\Models\Cart', 'item_id', 'id');
    }
}
