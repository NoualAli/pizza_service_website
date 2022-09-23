<?php

namespace App\Models;

use App\Concerns\HasMedia;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Restaurant extends Model
{
    use CrudTrait, HasMedia, SoftDeletes;

    protected $identifiableAttribute = 'name';

    protected $fillable = [
        'name',
        'slug',
        'cover',
        'time_slots',
        'minimum_order',
        'delivery_fee',
        'discount',
        'delivery_time',
        'address',
        'phone',
        'email',
        'longitude',
        'latitude',
        'delivery',
        'pickup',
        'on_the_spot'
    ];

    protected $appends = [
        'is_open',
    ];

    public function getCoverAttribute($cover)
    {
        return file_exists($cover) ? $cover : 'assets/no-image-available.svg';
    }

    public function getTodayTimeSlotsAttribute()
    {
        $time_slots = json_decode($this->time_slots, true);
        if ($time_slots) {
            foreach ($time_slots as $item) {
                if ($item['week_day'] == Carbon::today()->format('l')) {
                    return $item['opening'] . ' - ' . $item['closing'];
                }
            }
        }
    }

    public function getClosingAttribute()
    {
        $time_slots = json_decode($this->time_slots, true);
        foreach ($time_slots as $item) {
            if ($item['week_day'] == Carbon::today()->format('l')) {
                return $item['closing'];
            }
        }
    }

    public function getOpeningAttribute()
    {
        $time_slots = json_decode($this->time_slots, true);
        foreach ($time_slots as $item) {
            if ($item['week_day'] == Carbon::today()->format('l')) {
                return $item['opening'];
            }
        }
    }

    public function getIsOpenAttribute()
    {
        return Carbon::now()->gt($this->opening) && !Carbon::now()->gt($this->closing);
    }

    public function getCoordinatesAttribute()
    {
        return $this->latitude . ',' . $this->longitude;
    }

    /**
     * Scopes
     */
    public function scopeNearest($query)
    {
        $coords = getUserCoords();
        extract($coords);
        return $query->select(DB::raw('*, ROUND((6371000 * acos(cos(radians(' . $latitude . '))
        * cos(radians(latitude)) * cos(radians(longitude) - radians(' . $longitude . '))
        + sin(radians(' . $latitude . ')) * sin(radians(latitude)))) / 1000) AS distance'))
            ->having('distance', '<=', DEFAULT_DISTANCE)
            ->orderBy('distance');
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

    public function contacts()
    {
        return $this->hasMany(RestaurantContact::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}