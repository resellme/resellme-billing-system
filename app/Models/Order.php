<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'paynow_poll_url',
        'user_id',
        'status'
    ];

    /**
     * Get order items
     * 
     * @return HasMany
     * 
     */
    public function items() {
        return $this->hasMany(OrderItem::class);
    }
}
