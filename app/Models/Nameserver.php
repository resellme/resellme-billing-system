<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Domain;

class Nameserver extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_id',
        'ns1',
        'ns2',
        'ns3',
        'ns4'
    ];

    /**
     * Domain for the namservers
     * 
     * @return BelongsTo
     * 
     */
    public function domain(){
        return $this->belongsTo(Domain::class);
    }
}
