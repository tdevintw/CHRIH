<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){
        $products = $request->session()->products;
        var_dump($products);
    }
}
