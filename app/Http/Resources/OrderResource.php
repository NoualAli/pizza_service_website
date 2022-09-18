<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'full_name' => $this->full_name,
            'phone' => $this->phone,
            'order_type' => $this->order_type,
            'items_subtotal' => $this->items_subtotal,
            'total' => $this->total,
            'state' => $this->state,
            'created_at' => $this->created_at,
            'lines' => $this->lines->load('product')
        ];
    }
}