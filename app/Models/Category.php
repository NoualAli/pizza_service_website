<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = ['name'];

    public $timestamps = false;

    /**
     * Relationships
     */
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, (new RestaurantsCategories())->getTable());
    }
}