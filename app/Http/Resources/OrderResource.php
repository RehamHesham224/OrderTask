<?php

namespace App\Http\Resources;

use App\Traits\WithPagination;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    use WithPagination;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer' => [
                'id' => $this->customer->id,
                'name' => $this->customer->name,
                'email' => $this->customer->email,
            ],
            'product_name' => $this->product_name,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
