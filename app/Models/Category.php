<?php

namespace App\Models;

use App\Concerns\HasMedia;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, CrudTrait, HasMedia;

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