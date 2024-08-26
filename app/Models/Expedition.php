<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expedition extends Model
{
    use HasFactory;
    protected $fillable = [
        'bus_id',
        'from_location',
        'to_location',
        'ref_no',
        'name',
        'qty',
        'status',
        'recu',
        'prix',
        'valeur',
        'expeditair',
        'tel_expeditair',
        'destinatair',
        'tel_destinatair',
        'agent',
    ];


    public function bus()
    {
        return $this->belongsTo(bus::class);
    }

    public function fromLocation()
    {
        return $this->belongsTo(Location::class);
    }


}
