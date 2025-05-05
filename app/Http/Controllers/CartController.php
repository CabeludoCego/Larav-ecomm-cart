<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    public function addToCart($id, Request $request) {
        
        $product = Produto::find($id);
        $cart = session('cart', []); // IF cart doesnt exist, create a empty one.
        
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "description" => $product->description,
        ];
        session()->put("cart", $cart);
        // dd($cart);

        return redirect()->back()->with("success", "Product added to cart");
    }
}
