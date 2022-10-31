<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'description',
        'amount',
        'itemable_type',
        'itemable_id',
    ];

    public function itemable() {
        return $this->morphTo();
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
