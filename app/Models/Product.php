<?php

namespace App\Models;

use App\Concerns\HasMedia;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jackiedo\Cart\Traits\CanUseCart;

class Product extends Model
{
    use CrudTrait, HasMedia, CanUseCart, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price_norm',
        'price_perhe',
        'price_pannu',
        'menu_id',
        'restaurant_id'
    ];

    protected $cartTitleField = 'name';

    public $with = ['extras', 'recipes'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, (new Recipe)->getTable());
    }

    public function extras()
    {
        return $this->belongsToMany(Extra::class, (new ProductExtra)->getTable());
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