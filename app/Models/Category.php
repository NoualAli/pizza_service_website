<?php

namespace App\Models;

use App\Concerns\HasMedia;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use CrudTrait, HasMedia, SoftDeletes;

    protected $fillable = ['name', 'thumbnail'];

    public $timestamps = false;

    /**
     * Relationships
     */
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, (new RestaurantsCategories())->getTable());
    }
}