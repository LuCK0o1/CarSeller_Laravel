<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\User;
use App\Models\Maker;
use App\Models\State;
use App\Models\CarType;
use App\Models\FuelType;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $cars = Car::where('published_at','<',now())
            ->orderBy('published_at' , 'desc')
            ->with(['city','carType', 'fuelType' , 'primaryImage' , 'maker' , 'model'])
            ->limit(30)
            ->get();

        $makers = Maker::with(['models'])->get();
        $states = State::with(['cities'])->get();

        $carTypes = CarType::get();
        $fuelTypes = FuelType::get();

        $favCarIds = [];
        if(Auth::check()){
            $favCarIds = User::find(Auth::user()->id)
                            ->favouriteCars()
                            ->pluck('car_id')
                            ->toArray();
        }

        return View::first(['index' , 'home.index'] , [
            'cars' => $cars,
            'makers'=>$makers,
            'carTypes'=>$carTypes,
            'fuelTypes'=>$fuelTypes,
            'states'=>$states,
            'favCarIds'=>$favCarIds,
        ]);
    }

}
