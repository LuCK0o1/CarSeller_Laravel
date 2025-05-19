<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Car;
use App\Models\User;

class CarFeature extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'car_id';
    protected $fillable= [
        'car_id',
        'abs',
        'air_conditioning',
        'power_windows',
        'power_door_locks',
        'cruise_control',
        'bluetooth_connectivity',
        'remote_start',
        'gps_navigation',
        'heater_seats',
        'climate_control',
        'rear_parking_sensors',
        'leather_seats',
    ];

    public function car(): BelongsTo{
        return $this->belongsTo(Car::class , 'car_id');
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class , 'user_id');
    }
}
