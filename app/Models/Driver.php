<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'phone',
        'vehicle_type_id',
        'service',
        'status',
        'capacity',
        'dimension',
        'location',
        'latitude',
        'longitude',
        'note'
    ];

    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class);
    }

}
