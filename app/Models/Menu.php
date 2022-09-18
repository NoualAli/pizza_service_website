<?php

namespace App\Models;

use App\Concerns\HasMedia;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use CrudTrait, HasMedia, SoftDeletes;

    protected $identifiableAttribute = 'name';

    protected $fillable = ['name', 'restaurant_id', 'thumbnail'];

    public $timestamps = false;

    public $with = ['products'];


    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, (new RestaurantMenus)->getTable());
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}