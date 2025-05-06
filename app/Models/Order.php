<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Traits\filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    use filterable;

    protected $fillable = [
        'customer_id',
        'product_name',
        'quantity',
        'price',
        'status',
    ];
    protected $casts = [
        'status' => OrderStatus::class,
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
