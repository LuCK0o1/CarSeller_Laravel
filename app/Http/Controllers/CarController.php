<?php
//crete controller with this cmd prompt
//php artisan make:controller 'controller_name'

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\User;
use App\Models\Maker;
use App\Models\State;
use App\Models\CarFeature;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\FuelType;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = User::find($_GET['user_id'])
                    ->cars()
                    ->orderBy('created_at' , 'desc')
                    ->with(['maker' , 'model' , 'primaryImage'])
                    ->paginate(8);
        return view('car.index' , [
            'cars'=>$cars,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * Showing View for create form and connecting api store method
     */
    public function create()
    {
        $makers = Maker::with(['models'])->get();
        $states = State::with(['cities'])->get();

        $carTypes = CarType::get();
        $fuelTypes = FuelType::get();

        return view('car.create' , [
            'makers'=>$makers,
            'carTypes'=>$carTypes,
            'fuelTypes'=>$fuelTypes,
            'states'=>$states,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')){
            
            $car_data = $request->validate([
                'maker_id'      => 'required|exists:makers,id',
                'model_id'      => 'required|exists:models,id',
                'year'          => 'required|integer|digits:4|min:1900|max:' . date('Y'),
                'price'         => 'required|numeric|min:0',
                'vin'           => 'required|string|max:17',
                'mileage'       => 'required|integer|min:0',
                'car_type_id'   => 'required|exists:car_types,id',
                'fuel_type_id'  => 'required|exists:fuel_types,id',
                'city_id'       => 'required|exists:cities,id',
                'address'       => 'required|string|max:255',
                'phone'         => 'required|string|max:20',
                'description'   => 'nullable|string|max:1000',
                'published'     => 'nullable',
                'images'        => 'required|array',
            ]);

            if($request->input('published')){
                $car_data = array_merge($car_data , ['published_at'=>now()]);
            }

            unset($car_data['images']);

            $query = new Car();
            $query->fill($car_data);
            $query->user_id = Auth::user()->id;
            $query->save();

            $query->features()->create([
                'air_conditioning'       => $request->input('air_conditioning') ?? 0,
                'power_windows'          => $request->input('power_windows') ?? 0,
                'power_door_locks'       => $request->input('power_door_locks') ?? 0,
                'abs'                    => $request->input('abs') ?? 0,
                'cruise_control'         => $request->input('cruise_control') ?? 0,
                'bluetooth_connectivity'=> $request->input('bluetooth_connectivity') ?? 0,
                'remote_start'           => $request->input('remote_start') ?? 0,
                'gps_navigation'         => $request->input('gps_navigation') ?? 0,
                'heated_seats'           => $request->input('heated_seats') ?? 0,
                'climate_control'        => $request->input('climate_control') ?? 0,
                'rear_parking_sensors'   => $request->input('rear_parking_sensors') ?? 0,
                'leather_seats'          => $request->input('leather_seats') ?? 0,
            ]);

            if ($request->hasFile('images')) {
                $images = [];
                foreach ($request->file('images') as $i => $image) {
                    $path = $image->store('car_images', 'public');
                    $images[] = [
                        'car_id' => $query->id,
                        'image_path' => $path,
                        'position' => $i + 1
                    ];
                }
                CarImage::insert($images);
            }

            return redirect()->route('home');
        } else {
            return back()->withErrors('Method is not Supported');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {   

        return view('car.show' , [
            'car'=>$car,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * Showing View for Update form and connecting api update method
     */
    public function edit(Car $car)
    {   
        $makers = Maker::with(['models'])->get();
        $states = State::with(['cities'])->get();

        $carTypes = CarType::get();
        $fuelTypes = FuelType::get();

        return view('car.edit' , [
            'car'=>$car,
            'makers'=>$makers,
            'carTypes'=>$carTypes,
            'fuelTypes'=>$fuelTypes,
            'states'=>$states,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        if ($request->isMethod('put') || $request->isMethod('patch')){
            
            $car_data = $request->validate([
                'maker_id'      => 'required|exists:makers,id',
                'model_id'      => 'required|exists:models,id',
                'year'          => 'required|integer|digits:4|min:1900|max:' . date('Y'),
                'price'         => 'required|numeric|min:0',
                'vin'           => 'required|string|max:17',
                'mileage'       => 'required|integer|min:0',
                'car_type_id'   => 'required|exists:car_types,id',
                'fuel_type_id'  => 'required|exists:fuel_types,id',
                'city_id'       => 'required|exists:cities,id',
                'address'       => 'required|string|max:255',
                'phone'         => 'required|string|max:20',
                'description'   => 'nullable|string|max:1000',
            ]);

            if($request->input('published')){
                $car_data = array_merge($car_data , ['published_at'=>now()]);
            } else {
                $car_data = array_merge($car_data , ['published_at'=>null]);
            }

            unset($car_data['images']);

            $car->update($car_data);

            $car->features()->delete();
            $car->features()->create([
                'air_conditioning'       => $request->input('air_conditioning') ?? 0,
                'power_windows'          => $request->input('power_windows') ?? 0,
                'power_door_locks'       => $request->input('power_door_locks') ?? 0,
                'abs'                    => $request->input('abs') ?? 0,
                'cruise_control'         => $request->input('cruise_control') ?? 0,
                'bluetooth_connectivity' => $request->input('bluetooth_connectivity') ?? 0,
                'remote_start'           => $request->input('remote_start') ?? 0,
                'gps_navigation'         => $request->input('gps_navigation') ?? 0,
                'heated_seats'           => $request->input('heated_seats') ?? 0,
                'climate_control'        => $request->input('climate_control') ?? 0,
                'rear_parking_sensors'   => $request->input('rear_parking_sensors') ?? 0,
                'leather_seats'          => $request->input('leather_seats') ?? 0,
            ]);

            if ($request->hasFile('images')) {
                $car->images()->delete();
                $images = [];
                foreach ($request->file('images') as $i => $image) {
                    $path = $image->store('car_images', 'public');
                    $images[] = [
                        'car_id' => $car->id,
                        'image_path' => $path,
                        'position' => $i + 1
                    ];
                }
                CarImage::insert($images);
            }

            return redirect()->route('car.index' , ['user_id'=>$car->user_id]);
        } else {
            return back()->withErrors('Method is not Supported');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Car $car)
    {
        if($request->isMethod('delete')){
            $car->delete();
        }
    }

    public function search(Request $request){

        if($request->isMethod('get')){
            $maker_id = $request->input('maker_id');
            $model_id = $request->input('model_id');
            $state_id = $request->input('state_id');
            $city_id = $request->input('city_id');
            $car_type_id = $request->input('car_type_id');
            $year_from = $request->input('year_from');
            $year_to = $request->input('year_to');
            $price_from = $request->input('price_from');
            $price_to = $request->input('price_to');
            $fuel_type_id = $request->input('fuel_type_id');
            $sort = $request->input('sort');

            $query = Car::select('cars.*')
                        ->where('published_at' , '<' , now());

            if($maker_id){
                $query->where('maker_id' , '=' , $maker_id);
            } if ($model_id) {
                $query->where('model_id' , '=' , $model_id );
            } if ($state_id) {
                $query->join('cities' , 'cars.city_id','=','cities.id')
                    ->where('cities.state_id','=',$state_id);
            } if ($city_id) {
                $query->where('city_id' , '=' , $city_id );
            } if ($car_type_id) {
                $query->where('car_type_id' , '=' , $car_type_id );
            } if ($year_from && $year_to) {
                $query->whereBetween('year',[$year_from , $year_to] );
            } if ($price_from && $price_to) {
                $query->whereBetween('price',[$price_from , $price_to] );
            } if ($fuel_type_id) {
                $query->where('fuel_type_id' , '=' , $fuel_type_id );
            } if ($sort) {
                $query->orderBy('cars.price',$sort);
            }
        
        } else {

            $query = Car::where('published_at' , '<' , now())
                        ->orderBy('published_at' , 'desc')
                        ->with(['carType' , 'fuelType' , 'city' , 'maker' , 'model' , 'primaryImage']);
        }

        $cars = $query->paginate(15);

        $makers = Maker::with(['models'])->get();
        $states = State::with(['cities'])->get();

        $carTypes = CarType::get();
        $fuelTypes = FuelType::get();


        return view('car.search' , [
            'cars' => $cars,
            'makers'=>$makers,
            'carTypes'=>$carTypes,
            'fuelTypes'=>$fuelTypes,
            'states'=>$states,
        ]);
    }

    public function watchlist($user_id){
        $cars = User::find($user_id)
                    ->favouriteCars()
                    ->with(['city', 'city.state' ,'carType', 'fuelType' , 'primaryImage' , 'maker' , 'model']) 
                    //with this we can reduce the called queries like when we call city to get name we gnerating another query and to generate queries in loop it rudeces the perfomance on our website.
                    //car-item-card uses this relation so we expicitly mentioning all relation here so in less posible queries our work can be done. 
                    //we can see in get data in relations section.
                    //we can also provide nested relatiion here like state here we don't need state but to just see nested relation.
                    ->paginate(10);
        return view('car.watchlist' , [
            'cars'=>$cars,
        ]);
    }
}
