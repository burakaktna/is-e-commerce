<?php

namespace App\Http\Resources\Models\Order;

use App\Http\Resources\Models\OrderItem\OrderItemCollection;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Order */
class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customerId' => $this->customer_id,
            'items' => OrderItemCollection::make($this->whenLoaded('orderItems')),
            'total' => $this->total,
        ];
    }
}
