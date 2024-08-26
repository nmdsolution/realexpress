<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    use HasFactory;
    protected $fillable =[
        'point_darret',
        'ville',
        'quartier',
        'status',
    ];

    public function fromScheduleLists()
    {
        return $this->hasMany(schedule_List::class);
    }

    public function expedition()
    {
        return $this->hasMany(expedition::class);
    }
}
