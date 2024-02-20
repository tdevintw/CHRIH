<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->take(8)->get();
        // $products= Product::all();
        return view('home', compact('products'));
    }
}
