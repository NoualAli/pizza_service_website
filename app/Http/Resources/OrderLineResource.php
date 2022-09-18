<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderLineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $extra = implode(', ', array_keys(json_decode($this->extra, true)));
        return [
            'id' => $this->id,
            'product' => $this->product,
            'size' => $this->size,
            'extra' => $extra ? $extra : '-',
            'total_price' => number_format($this->total_price, 2),
            'quantity' => $this->quantity,
            'subtotal' => $this->subtotal
        ];
    }
}