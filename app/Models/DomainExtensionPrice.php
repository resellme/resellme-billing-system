<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainExtensionPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_extension_id',
        'amount'
    ];

    /**
     * Get domain extension for price
     * 
     * @return BelongsTo
     * 
     */
    public function domainExtension () {
        return $this->belongsTo(DomainExtension::class);
    }
}
