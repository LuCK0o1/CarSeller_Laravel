<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;

use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Car;
use App\Models\Model;

class Maker extends EloquentModel
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    public function cars(): HasMany{
        return $this->hasMany(Car::class , 'maker_id');
    }

    public function models(): HasMany{
        return $this->hasMany(Model::class , 'maker_id');
    }

    //If you created factory for the model and it does not gave nameing conventions then create function like this to connect to factory and do not forget to import factory here.
    //Also you have to mention protected model name in Factory file.

    //Naming convention : 
    //Model name -> Abc
    //Factory name -> AbcFactory

    //After calling the function we can generate the data.
    //but right now our model and factory has correct naming conventions.

    /* protected static function newfactory(){
        return MakerFactory::new();
    } */
}
