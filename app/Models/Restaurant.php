<?php

namespace App\Models;

use App\Concerns\HasMedia;
use App\Observers\RestaurantObserver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait, HasMedia;
    use HasFactory;

    protected $identifiableAttribute = 'name';

    protected $fillable = ['name', 'description', 'thumbnail', 'opening', 'closing', 'minimum_order'];

    public $with = ['users', 'locations'];


    /**
     * Getters
     */
    public function getClosingAttribute($closing)
    {
        return Carbon::parse($closing)->format('H:i');
    }

    public function getOpeningAttribute($opening)
    {
        return Carbon::parse($opening)->format('H:i');
    }

    public function getSlotsAttribute()
    {
        return "{$this->opening} - {$this->closing}";
    }

    /**
     * Relationships
     */
    public function users()
    {
        return $this->belongsToMany(User::class, (new RestaurantUsers)->getTable());
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, (new RestaurantMenus)->getTable());
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, (new RestaurantsCategories)->getTable());
    }

    public function locations()
    {
        return $this->hasMany(RestaurantLocation::class);
    }

    public function contacts()
    {
        return $this->hasMany(RestaurantContact::class);
    }
}