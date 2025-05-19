<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Car;


class FuelType extends Model
{   
    use HasFactory;
    //
    //protected $table = 'car_fuel_types';
    //protected $primaryKey = 'fuel_type_id';
    //protected $keyType = 'string';
    //public $incrementing = false;
    public $timestamps = false;

    //If timestamps is true
    //const CREATED_AT = 'create_date';
    //const UPDATED_AT = 'update_date';

    protected $fillable = [
        'name',
    ];

    public function cars(): HasMany{
        return $this->hasMany(Car::class , 'car_type_id');
    }
}
