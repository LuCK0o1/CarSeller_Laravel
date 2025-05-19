<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class WatchListController extends Controller
{
    public function store(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'userID'=>['required'],
                'carID'=>['required'],
            ]);

            $user = User::find((integer) $request->input('userID'));
            $user->favouriteCars()->attach([
                $request->input('carID')
            ]);
        }
    }

    public function destroy(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'userID'=>['required'],
                'carID'=>['required'],
            ]);

            $user = User::find((integer) $request->input('userID'));
            $user->favouriteCars()
                ->detach([
                    $request->input('carID')
                ]);
        }
    }

}
