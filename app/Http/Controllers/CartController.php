<?php

namespace App\Http\Controllers;

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
        // dd($cart);

        return redirect()->back()->with("success", "Product added to cart");
    }

    public function show (Request $request) {
        return view ("cart");
    }

    public function update (Request $request){
        info($request->all());

        $cart = session("cart");
        $cart[$request->product_id]["quantity"] = $request->quantity;

        session()->put("cart", $cart);
        return response()->json(["success" => 1]);
    }
}
