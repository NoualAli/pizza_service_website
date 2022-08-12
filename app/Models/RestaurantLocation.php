<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantLocation extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $identifiableAttribute = 'address';

    protected $fillable = ['address', 'restaurant_id'];

    public $timestamps = false;

    /**
     * Relationships
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}