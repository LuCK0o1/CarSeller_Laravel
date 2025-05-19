<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class CarAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        $query = Car::select('cars.*')
            ->where('published_at', '<', now())
            ->with(['carType', 'fuelType', 'city', 'maker', 'model', 'primaryImage']);

        // Apply filters only for GET requests
        if ($request->isMethod('get')) {
            // Filter by maker
            if ($request->filled('maker_id')) {
                $query->where('maker_id', $request->input('maker_id'));
            }

            // Filter by model
            if ($request->filled('model_id')) {
                $query->where('model_id', $request->input('model_id'));
            }

            // Filter by state (requires join with cities table)
            if ($request->filled('state_id')) {
                $query->join('cities', 'cars.city_id', '=', 'cities.id')
                    ->where('cities.state_id', $request->input('state_id'));
            }

            // Filter by city
            if ($request->filled('city_id')) {
                $query->where('city_id', $request->input('city_id'));
            }

            // Filter by car type
            if ($request->filled('car_type_id')) {
                $query->where('car_type_id', $request->input('car_type_id'));
            }

            // Filter by year range
            if ($request->filled(['year_from', 'year_to'])) {
                $query->whereBetween('year', [$request->input('year_from'), $request->input('year_to')]);
            }

            // Filter by price range
            if ($request->filled(['price_from', 'price_to'])) {
                $query->whereBetween('price', [$request->input('price_from'), $request->input('price_to')]);
            }

            // Filter by fuel type
            if ($request->filled('fuel_type_id')) {
                $query->where('fuel_type_id', $request->input('fuel_type_id'));
            }

            // Apply sorting if provided
            if ($request->filled('sort')) {
                $query->orderBy('cars.price', $request->input('sort'));
            } else {
                $query->orderBy('published_at', 'desc');
            }
        } else {
            // Default sorting for non-GET requests
            $query->orderBy('published_at', 'desc');
        }

        $cars = $query->paginate(9);

        return response()->json($cars);
    }
}
