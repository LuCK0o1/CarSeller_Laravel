<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MathController extends Controller
{
    public function sum (float $num1 , float $num2){
        return $num1 + $num2;
    }
    public function subtract (float $num1 , float $num2){
        return $num1 - $num2;
    }
    public function multiply (float $num1 , float $num2){
        return $num1 * $num2;
    }
    public function divide (float $num1 , float $num2){
        return $num1 / $num2;
    }
}
