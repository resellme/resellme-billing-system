<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\User;

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
    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get User for the order
     * 
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
