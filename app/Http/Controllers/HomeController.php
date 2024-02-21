<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Category;

class HomeController extends Controller
{
    public function index(){
        $products = Product::latest()->take(8)->get();
        $categories= Category::all();
     
        return view('home', compact('products','categories'));
    }
  
}
