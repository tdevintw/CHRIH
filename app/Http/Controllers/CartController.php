<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shopingcard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Models\Category;

class CartController
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $shopingcards = $user->shopingcards;
        $count = $shopingcards->count();
        if($request){
            $check = $request->session()->get('check');
        }
        $categories= Category::all();
        return view('cart', compact('shopingcards','count','check','categories'));
    }
    public function insert(Request $request)
    {

        $productcheck = Shopingcard::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->first();

        if ($productcheck) {
            $cartinfos = "Product Already Added";
        } else {
            $cart = new Shopingcard();
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $request->product_id;
            $cart->quantity = '1';
            $cart->save();
            $cartinfos = "Product Added Succesfuly";
        }
        return redirect()->route('cart.index')->with('cartinfos', $cartinfos);
    }
    public function delete(Request $request)
    {
        Shopingcard::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->delete();
        $cartinfos = "Product was removed from cart";
        return redirect()->route('cart.index')->with('cartinfos', $cartinfos);
    }

    public function check(Request $request)
    {   
        $product = Product::where('id', $request->product_id)->first();
        $stock = $product->quantity;
        if($request->number<=0){
            $check = [
                'check'=>"Enter a valid number",
                'id'=>$request->product_id
            ];
        }
        else if ($stock >= $request->number) {
            
            DB::table('shopingcards')
            ->where('user_id',Auth::user()->id)
            ->where('product_id',$request->product_id)
            ->update(['quantity'=>$request->number]);
            $check = [
                'check'=>"in stock",
                'id'=>$request->product_id
            ];
        } else {
            $check = [
                'check'=> $request->number . " " . " " . $request->product_name ." unavaible for now ",
                'id'=>$request->product_id
            ];
        }

        return redirect()->route('cart.index')->with('check', $check);
    }
}