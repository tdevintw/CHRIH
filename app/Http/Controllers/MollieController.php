<?php

namespace App\Http\Controllers;

use App\Models\Payement;
use App\Models\User;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Mollie\Laravel\Facades\Mollie;
 
class MollieController extends Controller
{
    public function mollie(Request $request)
    {
        


        $order_total_number = number_format($request->total, 2);      
        $total = str_replace(',', '', $order_total_number);
                $payment = Mollie::api()->payments->create([
                
                "amount" => [
                    "currency" => "EUR",
                    "value" => $total, 
                ],

                "description" => "Payement for your product",
                "redirectUrl" => route('succes'),
            ]);



            session()->put('paymentId', $payment->id);
            session()->put('quantity', $request->quantity );

            return redirect($payment->getCheckoutUrl(), 303);
    }

    public function succes(Request $request)
    {


        $paymentId = session()->get('paymentId');
        //dd($paymentId);
        $payment = Mollie::api()->payments->get($paymentId);
        //dd($payment);
        if($payment->isPaid())
        {
            $obj = new Payement();
            $obj->payment_id = $paymentId;
            $obj->numero_serie = $payment->description;
            $obj->quantity = session()->get('quantity');
            $obj->amount = $payment->amount->value;
            $obj->currency = $payment->amount->currency;
            $obj->payment_status = "Completed";
            $obj->payment_method = "Mollie";
            $obj->user_id = Auth::user()->id;

            $obj->save();

            session()->forget('paymentId');
            session()->forget('quantity');
            
            return redirect()->route('order.index');
        } else {

            return redirect()->route('home');
        }
    }

    public function cancel()
    {
        echo "Payment is cancelled.";
    }
}