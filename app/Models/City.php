<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Car;
use App\Models\State;

class City extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'state_id',
    ];

    public function state(): BelongsTo{
        return $this->belongsTo(State::class , 'state_id');
    }

    public function cars(): HasMany{
        return $this->hasMany(Car::class , 'city_id');
    }
}
