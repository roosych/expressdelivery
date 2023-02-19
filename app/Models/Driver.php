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
        'zipcode',
        'location',
        'latitude',
        'longitude',
        'future_zipcode',
        'future_location',
        'future_latitude',
        'future_longitude',
        'future_datetime',
        'note',
        'owner_id',
        'citizenship',
        'dnu',
    ];

    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function equipment()
    {
        return $this->belongsToMany(Equipment::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class)->where('driver_id', $this->id);
    }

}
