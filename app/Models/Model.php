<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Car;
use App\Models\Maker;

class Model extends EloquentModel
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'maker_id',
    ];

    public function maker(): BelongsTo{
        return $this->belongsTo(Maker::class , 'maker_id'); 
    }

    public function cars(): HasMany{
        return $this->hasMany(Car::class , 'model_id');
    }
}
