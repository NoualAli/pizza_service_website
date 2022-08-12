<?php

namespace App\Models;

use App\Concerns\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait, HasMedia;
    use HasFactory;

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