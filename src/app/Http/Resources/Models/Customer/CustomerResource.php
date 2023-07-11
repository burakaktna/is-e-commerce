<?php

namespace App\Http\Resources\Models\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Customer */
class CustomerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'since' => $this->since,
            'revenue' => $this->revenue
        ];
    }
}
