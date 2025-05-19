<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CarType;
use App\Models\FuelType;
use App\Models\Car;
use App\Models\State;
use App\Models\City;
use App\Models\CarFeature;
use App\Models\CarImage;
use App\Models\Model;
use App\Models\Maker;
use Illuminate\Database\Eloquent\Factories\Sequence;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* $carType =  [
            'Sedan',
            'Hatchback',
            'SUV',
            'Coupe',
            'Convertible',
            'Wagon',
            'Pickup Truck',
            'Van',
            'Crossover',
            'Minivan'
        ]; */

        CarType::factory()->sequence(
            ['name' => 'Sedan'],
            ['name' => 'Hatchback'],
            ['name' => 'SUV'],
            ['name' => 'Coupe'],
            ['name' => 'Convertible'],
            ['name' => 'Wagon'],
            ['name' => 'Pickup Truck'],
            ['name' => 'Van'],
            ['name' => 'Crossover'],
            ['name' => 'Minivan'],
        )->count(10)->create();

        /* $fuelTypes = [
            'Petrol',
            'Diesel',
            'Electric',
            'Hybrid',
            'Plug-in Hybrid',
            'Hydrogen Fuel Cell',
            'Compressed Natural Gas (CNG)',
            'Liquefied Petroleum Gas (LPG)'
        ]; */

        FuelType::factory()->sequence(
            ['name' => 'Petrol'],
            ['name' => 'Diesel'],
            ['name' => 'Electric'],
            ['name' => 'Hybrid'],
            ['name' => 'Plug-in Hybrid'],
            ['name' => 'Hydrogen Fuel Cell'],
            ['name' => 'CNG'],
            ['name' => 'LPG'],
        )->count(8)->create();

        $indianStatesAndCities = [
            'Andhra Pradesh' => ['Visakhapatnam', 'Vijayawada', 'Guntur', 'Nellore', 'Tirupati'],
            'Arunachal Pradesh' => ['Itanagar', 'Naharlagun', 'Pasighat', 'Tawang'],
            'Assam' => ['Guwahati', 'Silchar', 'Dibrugarh', 'Jorhat'],
            'Bihar' => ['Patna', 'Gaya', 'Muzaffarpur', 'Bhagalpur'],
            'Chhattisgarh' => ['Raipur', 'Bhilai', 'Bilaspur', 'Korba'],
            'Goa' => ['Panaji', 'Margao', 'Vasco da Gama', 'Mapusa'],
            'Gujarat' => ['Ahmedabad', 'Surat', 'Vadodara', 'Rajkot', 'Bhavnagar'],
            'Haryana' => ['Gurgaon', 'Faridabad', 'Panipat', 'Ambala', 'Hisar'],
            'Himachal Pradesh' => ['Shimla', 'Manali', 'Dharamshala', 'Mandi'],
            'Jharkhand' => ['Ranchi', 'Jamshedpur', 'Dhanbad', 'Bokaro'],
            'Karnataka' => ['Bengaluru', 'Mysuru', 'Mangaluru', 'Hubli', 'Belgaum'],
            'Kerala' => ['Thiruvananthapuram', 'Kochi', 'Kozhikode', 'Thrissur'],
            'Madhya Pradesh' => ['Bhopal', 'Indore', 'Gwalior', 'Jabalpur', 'Ujjain'],
            'Maharashtra' => ['Mumbai', 'Pune', 'Nagpur', 'Nashik', 'Aurangabad'],
            'Manipur' => ['Imphal', 'Thoubal', 'Bishnupur'],
            'Meghalaya' => ['Shillong', 'Tura', 'Jowai'],
            'Mizoram' => ['Aizawl', 'Lunglei', 'Champhai'],
            'Nagaland' => ['Kohima', 'Dimapur', 'Mokokchung'],
            'Odisha' => ['Bhubaneswar', 'Cuttack', 'Rourkela', 'Puri'],
            'Punjab' => ['Ludhiana', 'Amritsar', 'Jalandhar', 'Patiala'],
            'Rajasthan' => ['Jaipur', 'Jodhpur', 'Udaipur', 'Kota', 'Ajmer'],
            'Sikkim' => ['Gangtok', 'Namchi', 'Gyalshing'],
            'Tamil Nadu' => ['Chennai', 'Coimbatore', 'Madurai', 'Tiruchirappalli', 'Salem'],
            'Telangana' => ['Hyderabad', 'Warangal', 'Nizamabad', 'Karimnagar'],
            'Tripura' => ['Agartala', 'Udaipur', 'Dharmanagar'],
            'Uttar Pradesh' => ['Lucknow', 'Kanpur', 'Varanasi', 'Agra', 'Meerut'],
            'Uttarakhand' => ['Dehradun', 'Haridwar', 'Nainital', 'Haldwani'],
            'West Bengal' => ['Kolkata', 'Howrah', 'Durgapur', 'Asansol', 'Siliguri'],
            'Delhi' => ['New Delhi', 'Dwarka', 'Rohini', 'Karol Bagh'],
            'Jammu and Kashmir' => ['Srinagar', 'Jammu', 'Anantnag', 'Baramulla'],
            'Ladakh' => ['Leh', 'Kargil']
        ];

        foreach ($indianStatesAndCities as $state => $cities){
            State::factory()
                ->state(['name' => $state])
                ->has(
                    City::factory()
                        ->count(count($cities))->sequence(...array_map(fn($city) => ['name' => $city] , $cities))
                )->create();
        }

        $carManufacturers = [
            'Maruti Suzuki' => ['Swift', 'Baleno', 'Alto', 'WagonR', 'Dzire', 'Ertiga', 'Brezza'],
            'Hyundai' => ['i20', 'i10', 'Creta', 'Venue', 'Verna', 'Aura', 'Tucson'],
            'Tata Motors' => ['Nexon', 'Harrier', 'Punch', 'Altroz', 'Tiago', 'Safari'],
            'Mahindra' => ['XUV700', 'Scorpio-N', 'Bolero', 'Thar', 'XUV300'],
            'Kia' => ['Seltos', 'Sonet', 'Carens', 'EV6'],
            'Toyota' => ['Innova Crysta', 'Fortuner', 'Glanza', 'Urban Cruiser Hyryder', 'Hilux'],
            'Honda' => ['City', 'Amaze', 'Elevate', 'WR-V'],
            'Renault' => ['Kwid', 'Triber', 'Kiger', 'Duster'],
            'Skoda' => ['Slavia', 'Kushaq', 'Octavia', 'Superb'],
            'Volkswagen' => ['Virtus', 'Taigun', 'Tiguan', 'Polo'],
            'MG (Morris Garages)' => ['Hector', 'Astor', 'Gloster', 'ZS EV'],
            'Nissan' => ['Magnite', 'Kicks'],
            'Jeep' => ['Compass', 'Meridian', 'Wrangler'],
            'BMW' => ['3 Series', '5 Series', 'X1', 'X3', 'X5', 'iX'],
            'Mercedes-Benz' => ['C-Class', 'E-Class', 'GLA', 'GLC', 'GLE'],
            'Audi' => ['A4', 'A6', 'Q3', 'Q5', 'Q7'],
            'Volvo' => ['XC40', 'XC60', 'XC90', 'S90'],
            'Ford' => ['EcoSport', 'Endeavour', 'Figo'] // Still in use or resale despite exiting India
        ];

        foreach ($carManufacturers as $maker => $models){
            Maker::factory()
                ->state(['name' => $maker])
                ->has(
                    Model::factory()
                        ->count(count($models))->sequence(...array_map(fn($model) => ['name' => $model] , $models))
                )->create();
        }

        User::factory()
            ->count(3)
            ->create();

        $dummyImages = [
             'https://dummyimage.com/640x480/cccccc/000000.png&text=640x480',
             'https://placehold.co/640x480.png?text=640x480',
             'https://picsum.photos/640/480',
             'https://placehold.jp/640x480.png?text=640x480',
             'http://placebeard.it/640x480',
        ];
        User::factory()
            ->count(2)
            ->has(
                Car::factory()
                    ->count(50)
                    ->has(
                        CarImage::factory()
                            ->count(5)
                            ->sequence(fn (Sequence $sequence) => [
                                'image_path' => 'https://picsum.photos/640/480' , 
                                'position' => $sequence->index % 5 + 1]) ,
                        'images'
                    )
                    ->hasFeatures(),
                'favouriteCars'
            )
            ->create();
    }
}
