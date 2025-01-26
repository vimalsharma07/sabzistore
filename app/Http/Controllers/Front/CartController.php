<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Product;

use Auth;
use Agent;

class CartController extends Controller
{
    // Add product to cart or update quantity if it already exists
    public function addToCart(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);
        $attributes = $request->input('attributes', []);
        $mrp = $request->input('mrp', 0);
        $product=   Product::where('id',$productId)->first();
        $product->attributes= $attributes;
        $product->mrp= $mrp;
        // Generate unique key for product + attributes combination
        $uniqueKey = $this->generateUniqueKey($productId, $attributes);

        if (isset($cart[$uniqueKey])) {
            $cart[$uniqueKey]['quantity'] += $quantity;
            $product->quantity = $cart[$uniqueKey]['quantity']; 

        } else {
            $cart[$uniqueKey] = [
                'product_id' => $productId,
                'attributes' => $attributes,
                'product'=>$product,
                'quantity'=>1,
            ];
            $product->quantity = 1; 

        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Product added/updated successfully',
            'cart' => $cart,
            "product"=>$product,
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


    public function Cart(Request $request){
       
        $cart = session()->get('cart', []);
        $tip = session('selected_tip', 0);  
        $user= Auth::user();
        if($user){
            $address=   Address::where('user_id', $user->id)->where('default',0)->first();

        }else{
            $address= '';
        }

        if ($request->ajax()) { 
            $cart = session()->get('cart', []); 
            $itemTotal = 0;
            foreach ($cart as $item) {
                $price = array_values($item['attributes'])[0] * $item['quantity'];
                $itemTotal += $price;
            }

            $fees = getAllFees($itemTotal); 
            return response()->json([
                'cart' => $cart,
                 'fees' => $fees,
                'tip'=> session('selected_tip', 0),

            ]);
        }
        if(!Agent::isMobile()){
            return redirect()->back();
        }
        return view ('frontend.components.cart.mobilecartview',['cart'=>$cart, 'tip'=>$tip, 'address'=> $address]);
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
            session()->put('cart', $cart);  // Save updated cart
        } else {
            return response()->json(['message' => 'Product not found in cart']);
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

    public function saveTip(Request $request)
    {
        $request->validate(['tip' => 'required|numeric']);
        session(['selected_tip' => $request->tip]);
        return response()->json(['message' => 'Tip saved successfully']);
    }
    
    public function getTip()
    {
        $tip = session('selected_tip', 0);  // Default to 0 if no tip is set
        return response()->json(['tip' => $tip]);
    }
    

}
