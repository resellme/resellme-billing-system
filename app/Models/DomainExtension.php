<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DomainExtensionPrice;

class DomainExtension extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Get domain ext price
     * 
     * @return HAsMany
     * 
     */
    public function domainExtensionPrice() {
        return $this->hasMany(DomainExtensionPrice::class);
    }
}
