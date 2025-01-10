<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Add product to cart or update quantity if it already exists
    public function addToCart(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);
        $attributes = $request->input('attributes', []);

        // Generate unique key for product + attributes combination
        $uniqueKey = $this->generateUniqueKey($productId, $attributes);

        if (isset($cart[$uniqueKey])) {
            $cart[$uniqueKey]['quantity'] += $quantity; // Increment quantity
        } else {
            $cart[$uniqueKey] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'attributes' => $attributes,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Product added/updated successfully',
            'cart' => $cart,
        ]);
    }

    // Get cart details for a specific product and attributes
    public function getCart(Request $request, $productId)
    {

        $cart = session()->get('cart', []);
        $attributes = $request->input('attributes', []);

        $uniqueKey = $this->generateUniqueKey($productId, $attributes);
        $product = $cart[$uniqueKey] ?? null;

        return response()->json([
            'inCart' => $product ? true : false,
            'product' => $product,
        ]);
    }

    public function clearCart()
{
    // Remove the entire cart from the session
    session()->forget('cart');
    
    // Optionally return a response
    return response()->json(['message' => 'Cart has been cleared successfully.']);
}


    public function Cart(){
        $cart = session()->get('cart', []);
        return view ('frontend.components.cart.mobilecartview',['cart'=>$cart]);
    }

    // Remove a product from the cart
    public function removeFromCart(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        $attributes = $request->input('attributes', []);
        $uniqueKey = $this->generateUniqueKey($productId, $attributes);

        if (isset($cart[$uniqueKey])) {
            if ($cart[$uniqueKey]['quantity'] > 1) {
                $cart[$uniqueKey]['quantity'] -= 1;
            } else {
                unset($cart[$uniqueKey]);
            }

            session()->put('cart', $cart);
        }

        return response()->json([
            'message' => 'Product updated successfully',
            'cart' => $cart,
        ]);
    }

    // Check if a product exists in the cart
    public function check(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        $attributes = $request->input('attributes', []);
        $uniqueKey = $this->generateUniqueKey($productId, $attributes);

        $product = $cart[$uniqueKey] ?? null;

        return response()->json([
            'inCart' => $product ? true : false,
            'product' => $product,
        ]);
    }

    // Generate a unique key for a product and attributes
    private function generateUniqueKey($productId, $attributes)
    {
        return $productId . '-' . md5(json_encode($attributes));
    }

public function addTip(Request $request)
{
    $tip = $request->input('tip', 0); // Get tip value from the form
    session(['selected_tip' => $tip]); // Store tip in session

    return redirect()->back()->with('success', 'Tip updated successfully!');
}

}
