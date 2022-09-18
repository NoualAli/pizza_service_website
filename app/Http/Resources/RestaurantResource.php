<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cover' => $this->cover,
            'today_time_slots' => $this->today_time_slots,
            'address' => $this->address,
            'link' => route('restaurants.single', $this),
            'is_open' => $this->is_open,
            'delivery_time' => $this->delivery_time,
            'distance' => $this->distance,
            'avg_price' => number_format($this->products()->avg('price_norm')),
            'categories_string' => implode(', ', $this->categories->pluck('name')->toArray()),
            'categories' => $this->categories
        ];
    }
}