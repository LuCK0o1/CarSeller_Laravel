<?php

//Resource Controler Comes with predefined methods
//create command
//php artisan make:controller 'controller_name' -r

//or

//php artisan make:controller 'controller_name' --resource

//or

//php artisan make:controller 'controller_name' --api
//This make command strictly makes only four api methods means it does not include create or edit methods.

//For more controller create command 
//php artisan make:controller --help

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Product extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * Showing View for create form and connecting api store method
     */
    public function create()
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
     * Show the form for editing the specified resource.
     * Showing View for Update form and connecting api update method
     */
    public function edit(string $id)
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
}
