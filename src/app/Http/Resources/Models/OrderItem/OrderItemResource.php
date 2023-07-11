<?php

namespace App\Http\Resources\Models\OrderItem;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin OrderItem */
class OrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'productId' => $this->product_id,
            'quantity' => $this->quantity,
            'unitPrice' => $this->unit_price,
            'total' => $this->total
        ];
    }
}
