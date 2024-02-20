<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->take(8)->get();
        return view('home', compact('products'));

    }
    public function show(){
        $categories = Categorie::all();
        return view('show', compact('categories'));
    }
    public function search(){
        $q = request()->input('q');
        $products = Product::where('name', 'like', "%$q%")
                        ->get(); 
        return view('search', compact('products'));
    }
    
}
