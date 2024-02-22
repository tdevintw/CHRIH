<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Category;

class ProductController extends Controller
{
    // public function index(){
    //     $products = Product::latest()->take(8)->get();
    //     return view('home', compact('products'));

    // }
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

        return view('store', compact('categories', 'products'));
    }
    public function search(){
        $q = request()->input('q');
        $categories = Categorie::all();
        $products = Product::where('name', 'like', "%$q%")
                        ->get(); 
                        $productsByCategory = Product::whereHas('category', function ($query) use ($q) {
                            $query->where('name', 'like', "%$q%");
                        })->get();
                        $products = $products->merge($productsByCategory);

        return view('search', compact('products','categories'));
    }
    public function addToFavoris(Product $product)
{
    $user = auth()->user();
    $user->likedProducts()->attach($product->id);
    return redirect()->route('home');

}

public function showFavoris(){
    $products = Auth::user()->likedProducts;
    $categories =  Category::all();
    return view('favoris', compact('products','categories'));

}
}


