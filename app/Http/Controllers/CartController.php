<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;


class CartController extends Controller
{
    public function addToCart(Request $request)
    {
    
        // Validate the request and check product availability.
        $product = Product::find($request->product_id);
    
        if (!$product || $product->stock < $request->quantity) {
            return response()->json(['message' => 'Product not available'], 400);
        }
    
        // Check if the product is already in the cart.
        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();
    
        if ($cart) {
            // If the product exists in the cart, update its quantity.
            $newQuantity = $cart->quantity + $request->quantity;
            $cart->update(['quantity' => $newQuantity]);
        } else {
            // If the product doesn't exist in the cart, insert it.
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }
    
        return response()->json(['message' => 'Product added to cart']);
    }
    
}
    

