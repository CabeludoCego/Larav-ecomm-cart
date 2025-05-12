<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produto;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    public function addToCart($id, Request $request) {
        
        $product = Produto::find($id);
        $cart = session('cart', []); // IF cart doesnt exist, create a empty one.
        
        if (isset($cart[$id])) {  // IF Item exists.
            $cart[$id]['quantity'] += 1;
        } else {                  // IF Item is being added for 1st time,
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "description" => $product->description,
            ];
        }
        session()->put("cart", $cart);
        return redirect()->back()->with("success", "Product added to cart");
    }

    public function show (Request $request) {
        return view ("cart");
    }

    public function update (Request $request){
        // info($request->all());
        $cart = session("cart");

        if($request->type == "update"){
            $cart[$request->product_id]["quantity"] = $request->quantity;
        } else {
            unset($cart[$request->product_id]);
        }
        session()->put("cart", $cart);

        $view = view("cartProducts")->render();
        return response()->json(["success" => $view]);
    }

    public function order(Request $request) {

        $order = Order::create([
            "user_id" => auth()->user()->id,
        ]);

        // dd(session("cart"));
        $amount = 0;
        foreach (session("cart") as $key => $value) {
            $order->products()->create([
                "product_id" => $key,
                "quantity" => $value["quantity"],
                "price" => $value["price"],

            ]);

            $amount += ($value["quantity"] * $value["price"]);
        }
        $order->amount = $amount;
        $order->save();

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $successURL = route('order.success').'?session_id={CHECKOUT_SESSION_ID}&order_id='.$order->id;
        $response = $stripe->checkout->sessions->create([
            'success_url' => $successURL,
            'customer_email' => auth()->user()->email,
            'line_items' => [
                [
                    'price_data' => [
                        "product_data" => [
                            "name" => "Shping"
                        ],
                        "unit_amount" => 100 * $amount,
                        "currency" => "USD"
                    ],
                    'quantity' => 1
                ],
            ],
            'mode' => 'payment',
        
        ]);
        return redirect($response['url']);
    }

    public function OrderSuccess (Request $request) {
        // dd($request->all());

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $session = $stripe->checkout->sessions->retrieve($request->session_id);

        if($session->status == "complete"){
            $order = Order::find($request->order_id);
            $order->status = 1;
            $order->strpe_id = $session->id; // if order complete, updt data
            $order->save();

            return redirect()->route('home')->with('success', "Order placed!");
        }
    
        $order = Order::find($request->order_id);
        $order->status = 2;       
        $order->save();
        return redirect()->route('home')->with('failed', "Order could not be completed.");
    }


}
