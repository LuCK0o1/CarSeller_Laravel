<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\City;

class State extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    public function cities(): HasMany{
        return $this->hasMany(City::class , 'state_id');
    }
}
