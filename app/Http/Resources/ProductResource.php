<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'description' => $this->description,
            'price' => number_format($this->price),
            'price_medium' => $this->price_medium,
            'price_large' => $this->price_large,

            'extra' => $this->extra,
            'recipe' => implode(', ', $this->recipes->pluck('name')->toArray()),
            'menu' => $this->menu,
        ];
    }
}