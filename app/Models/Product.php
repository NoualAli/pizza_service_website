<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'price_medium',
        'price_large',
        'menu_id',
        'restaurant_id'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, (new Recipe)->getTable());
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}