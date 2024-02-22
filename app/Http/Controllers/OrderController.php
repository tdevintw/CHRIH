<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shopingcard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        
        $shopingcards = Shopingcard::join('products', 'shopingcards.product_id', '=', 'products.id')
                                ->where('shopingcards.user_id', $user_id)
                                ->where('products.quantity', '>', 0)
                                ->get();

        $order = new Order();
        $order->payment_id = session()->get('payement_id');
        $order->user_id = $user_id; 
        $order->save();
        session()->forget('paymentId');
        session()->forget('payement_id');
        session()->forget('quantity');

        foreach($shopingcards as $product):
        $item = new Item();
        $item->order_id = $order->id;
        $item->product_id = $product['id'];
        $product = Shopingcard::where('user_id',$user_id)->where('product_id',$product['id'])->first();
        $item->quantity = $product->quantity;
        $item->save();
        endforeach;   
        $user = Auth::user();
        
        foreach($shopingcards as $card):
        $product = Product::where('id', $card->product_id)->first();
        $first = Shopingcard::where('user_id',$user->id)->where('product_id',$card->product_id)->first();
        
        $stock = $first->quantity;
        $newquantity = $product->quantity - $stock;   
        Product::where('id',$card->product_id)->update(['quantity'=> $newquantity]);
        DB::table('shopingcards')->where('user_id',$user_id)->where('product_id',$card->product_id)->delete();

        endforeach;
        return redirect()->route('cart.index');

    }
}
