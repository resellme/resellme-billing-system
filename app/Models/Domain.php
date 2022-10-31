<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nameserver;
use App\Models\Contact;
use App\Models\User;
use App\Models\OrderItem;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'registration_date',
        'expiration_date',
        'user_id',
    ];

    /**
     * Nameservers for the domain
     * 
     * @return HasOne
     * 
     */
    public function nameserver() {
        return $this->hasOne(Nameserver::class);
    }

    /**
     * Contact for the domain
     * 
     * @return HasOne
     * 
     */
    public function contact() {
        return $this->hasOne(Contact::class);
    }

    /**
     * All domains should be lower case
     * 
     * @return void
     * 
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    /**
     * Get User For domain
     * 
     * return BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orderItem() {
        return $this->morphOne(OrderItem::class, 'itemable');
    }
}
