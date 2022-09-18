<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'extras',
        'size',
        'price',
        'additional_informations'
    ];

    public $timestamps = false;

    public $with = ['product'];

    protected $casts = [
        'extra' => 'array',
        'price' => 'float',
        'quantity' => 'integer'
    ];

    /**
     * Getters
     */
    public function getExtraStrAttribute()
    {
        return implode(', ', array_keys(json_decode($this->extras, true)));
    }

    public function getPriceAttribute($price)
    {
        return number_format($price, 2) . EURO_SIGN;
    }

    public function getSizeAttribute($size)
    {
        return ucfirst(strtolower($size));
    }

    /**
     * Relationships
     */

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}