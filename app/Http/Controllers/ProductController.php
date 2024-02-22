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
    public function show($id){
        $categories = Categorie::all();
        $products= Product::where('categorie_id',$id)->get();
        return view('show', compact('categories','products'));
    }



    public function showProductsByCategory($categoryId)
    {
        
        $category = Categorie::findOrFail($categoryId);
        $products = Product::where('category_id', $category->id)->get();
        return view('product.show_by_category', compact('category', 'products'));
    }

    public function store(){
        $categories = Categorie::all();
        $products = Product::all();

        return view('store', compact('categories', 'products','categoryId'));
    }
    public function search(){
        $categories = Categorie::all();
        $q = request()->input('q');
        $products = Product::where('name', 'like', "%$q%")
                        ->get(); 
        return view('search', compact('products','categories'));
    }
    
}
