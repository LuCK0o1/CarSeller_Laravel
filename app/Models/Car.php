<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\CarFeature;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\Maker;
use App\Models\FuelType;
use App\Models\City;
use App\Models\User;
use App\Models\Model;

class Car extends EloquentModel
{
    use HasFactory,SoftDeletes;

    protected $fillable= [
        'maker_id',
        'model_id',
        'year',
        'price',
        'vin',
        'mileage',
        'car_type_id',
        'fuel_type_id',
        //'user_id',
        'city_id',
        'address',
        'phone',
        'description',
        'published_at',
        'deleted_at',
    ];

    public function carType(): BelongsTo{
        return $this->belongsTo(CarType::class , 'car_type_id');
        //Here foreign key of our table 
        //It will auto ddetects id using name of our function
        //carType -> car_type_id
    }

    public function fuelType(): BelongsTo{
        return $this->belongsTo(FuelType::class , 'fuel_type_id');
        //Here foreign key of our table 
    }

    public function maker(): BelongsTo{
        return $this->belongsTo(Maker::class , 'maker_id'); 
    }

    public function model(): BelongsTo{
        return $this->belongsTo(Model::class , 'model_id'); 
    }

    public function owner(): BelongsTo{
        return $this->belongsTo(User::class , 'user_id'); 
    }

    public function city(){
        return $this->belongsTo(City::class , 'city_id');
    }

    public function features(): HasOne {
        return $this->hasOne(CarFeature::class , 'car_id');
        
        //Foreign Key parameter is optional if your current model name is Car then laravel auto detects car_id in given Model
        //But if you have foreign key with diffrent name like cars_id or id_car you have to mention foreign key
        //Good practice to mention the key even if laravel auto detects it.
    }

    public function primaryImage(): HasOne {
        return $this->hasOne(CarImage::class , 'car_id')->oldestOfMany('position');
    }

    public function images(): HasMany {
        return $this->hasMany(CarImage::class , 'car_id');
    }

    public function getCreateDate(): string {
        return (new \Carbon\Carbon($this->created_at))->format('Y-m-d');
    }

    public function favouredUsers(): BelongsToMany {
        return $this->belongsToMany(User::class , 'favourite_cars' ,'car_id' , 'user_id');
    }
}
