<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Domain;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_id',
        'first_name',
        'last_name',
        'email',
        'company',
        'mobile',
        'street_address',
        'core_business',
        'city',
        'country'
    ];

    /**
     * Domain for the contact
     * 
     * @return BelongsTo
     * 
     */
    public function domain() {
        return $this->belongsTo(Domain:class);
    }
}
