<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = ['name', 'extra_price'];

    public $timestamps = false;

    /**
     * Getters
     */
    public function getAsExtraAttribute()
    {
        return !is_null($this->extra_price);
    }
}