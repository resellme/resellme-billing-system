<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;

class Hosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain',
        'billing_cycle',
        'next_due_date',
        'username',
        'password',
        'package',
        'user_id',
    ];

    protected $casts = [
        'next_due_date' => 'date',
    ];

    protected $hidden = [
        'password'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orderItem() {
        return $this->morphOne(OrderItem::class, 'itemable');
    }
}
