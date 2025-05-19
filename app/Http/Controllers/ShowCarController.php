<?php

//Sinle action controller
//create command
//php artisan make:controller 'controller_name' --invokable

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowCarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return "--invokable";
    }
    //__invoke is dunder method.
    //You can make another functions.
}
