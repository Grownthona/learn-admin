<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function show(){
        $car = array(["brand"=>"Ford", "model"=>"Mustang", "year"=>1964],["brand"=>"Axio", "model"=>"Toyota", "year"=>2014]);

        //$itemlist = (object)$car;
        //return view("test",compact("itemlist"));
        return 
    }
}
