<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bus extends Model
{
    use HasFactory;
    protected $fillable = [
    'nom',
    'numero_du_bus',
    'status',
];

public function scheduleLists()
{
    return $this->hasMany(Schedule_List::class);
}
public function expedition()
{
    return $this->hasMany(expedition::class);
}
}
