<?php

use App\Http\Controllers\ShowCarController;
use App\Http\Controllers\Product;
use App\Http\Controllers\MathController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarAjaxController;
use App\Http\Controllers\WatchListController;
use App\Http\Middleware\LoginAuth;

Route::get('/', [HomeController::class , 'index'])->name('home');

Route::get('/about', function () {
    return view('about'); // Render blade.php view here from resources views
})->name('about'); //( Good Practice ) With this name we can access the url anywhere in app 

Route::get('/signup' , [SignupController::class , 'signupView'])->name('signup');

Route::post('/signup/create-user' , [SignupController::class , 'create'])->name('signup.create');

Route::post('/signup/otp-verification' , [SignupController::class , 'otpVerification'])->name('signup.verify');

Route::get('/login' , [LoginController::class , 'loginView'])->name('login');

Route::post('/login-confirm' , [LoginController::class , 'login'])->name('loginConfirm');

Route::get('/car/search' , [CarController::class , 'search'])->name('car.search');

Route::get('/car-ajax/search' , [CarAjaxController::class , 'search'])->name('car-ajax.search');


Route::middleware(LoginAuth::class)->group(function() {
    
    Route::get('/car/watchlist/{user_id}' , [CarController::class , 'watchlist'])->name('car.watchlist');

    Route::resource('car',CarController::class);

    Route::apiResource('car-ajax',CarAjaxController::class);

    Route::post('car/watchlist/add',[WatchListController::class , 'store'])->name('addToFavorites');

    Route::post('/car/watchlist/remove',[WatchListController::class , 'destroy'])->name('removeFromFavorites');

    Route::get('/logout',[LoginController::class , 'logout'])->name('logout');

});















/*

    //Access methods or callback functions from controller.
    Route::get('/cars',[CarController::class , 'index']);

    Route::controller(CarController::class)->group(function() {
        Route::get('/car'  , 'index');
        Route::get('/myCar'  , 'myCar');
        Route::get('/notCar' , 'notCar');
    });

    Route::controller(MathController::class)->group(function() {
        Route::get('/sum/{num1}/{num2}' , 'sum'          )
            ->whereNumber(['num1','num2']);
        Route::get('/subtract/{num1}/{num2}' , 'subtract')
            ->whereNumber(['num1','num2']);
        Route::get('/multiply/{num1}/{num2}' , 'multiply')
            ->whereNumber(['num1','num2']);
        Route::get('/divide/{num1}/{num2}' , 'divide'    )
            ->whereNumber(['num1','num2']);
    });

    //Direct action or method controller direcly executes providing controller no need for mentioning methods.
    Route::get("/show-car",ShowCarController::class);

    //Resource controller
    Route::resource('/products' , Product::class);
    //Route::apiResource('/products' , Product::class); //Strictly stores api methods only

    

    
    Route::get('/', function () {
        $user = [
            "username"=>"Shubham",
            "Type"=>"Admin",
        ];
        $aboutPageUrl = route('about');
        $reviewPageUrl = route('review' , ['lang'=>'en','id'=>2,'reviewID'=>32]);
        dump($aboutPageUrl); //for debug prints any variables
        dump($reviewPageUrl); //url with parameters
        dd($user); //debugging prints and exit code at that time.
        return view('welcome'); // cause dd won't be executed.
    });

    Route::get('/about-us', function () {
        return view('about'); // Render blade.php view here from resources views
    })->name('about'); //( Good Practice ) With this name we can access the url anywhere in app 

    Route::get('/product/{id}', function (int $id) {
        return "Product ID = $id";
    })->whereNumber('id');

    Route::get(
        '{lang}/product/{id}/review/{reviewID}', 
        function (string $lang , int $id , int $reviewID) {
            $get_data = [
                "language"=>$lang,
                "Product ID"=>$id,
                "Review ID"=>$reviewID,
            ];
            dump($get_data);
            //return redirect()->route('about');
            //or
            return to_route('about');
    })->whereNumber(['id', 'reviewID'])
    ->whereAlpha('lang')
    ->name('review');

    Route::get(
        '{lang}/product/', 
        function (string $lang) {
            $get_data = [
                "language"=>$lang,
            ];
            dd($get_data);
    })->whereIn('lang' , ['en' , 'jap' , 'in' , 'ch']);

    Route::get(
        "/product/{category?}",
        function (string $category = "ball"){
            return "Product Category is $category";
        }
    )->whereAlpha('category');

    Route::get(
        "/user/{username}",
        function (string $username){
            return "User username = $username";
        }
    )->where('username' , '[a-z]+'); //REGEX for only lowercase

    Route::get(
        "{lang}/user/{id}",
        function (string $lang , int $id){
            $userdata = [
                "Language"=>$lang,
                "User ID"=>$id,
            ];
            dd($userdata);
        }
    )->where(['lang'=>'[a-z]{2}' , 'id'=>'\d{4,}']); //REGEX for only 2 lowecase latters and 4 digits

    Route::get(
        "/search/{search}",
        function (string $search){
            return "<h1>$search</h1>";
        }
    )->where('search','.+'); //REGEX for any special character or  any character
    

    
    404 page
    Route::fallback(function() {
        //return "404";
        //or
        return redirect()->back()->with('Error' , '404 Page not Found')
            ?: redirect('/'); // Redirect to the homepage if no previous page exists
    }); 
    // Not using now defauld 404 is good 


    => Methods :
    Route::get($uri , $callbake(function) or action);
    Route::post($uri , $callbake(function) or action);
    Route::put($uri , $callbake(function) or action);
    Route::patch($uri , $callbake(function) or action);
    Route::delete($uri , $callbake(function) or action);
    Route::options($uri , $callbake(function) or action);

    => For Multiple methods : 
    Route::match(['get' , 'post'] , $uri , $callbake(function) or action);

    => Redirect :
    Route::redirect($uri1 : From , $uri2 : To , (int) $status);

    => Render View :
    Route::view($uri , (string) view , (array) $context or $params);

    => Group Routing :
    Route::prefix(prefix : (string) $route)->group(function () {
        Route::get()
    })

    Route::name('admin.')->group(function () {
        Route::get()->name('some')
        //to access this route with the name you have to use 'admin.some'
    })

    => FallBack or 404 Route :
    Route::fallback(function() {
        return "404";
        //or
        return redirect()->back()->with('Error' , '404 Page not Found')
    }) // Not using now defauld 404 is goood 

*/
