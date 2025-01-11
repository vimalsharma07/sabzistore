<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Str;


class OrderController extends Controller
{
    public function saveOrder(Request $request)
    {
        // Retrieve cart data from session or request
        $cart = Session::get('cart', []); // Assuming cart data is stored in session
    
        if (empty($cart)) {
            return response()->json(['message' => 'Cart is empty.'], 400);
        }
    
        // Retrieve tip from session
        $tip = Session::get('selected_tip', 0);
    
        // Initialize order values
        $products = [];
        $orderProducts = [];
        $totalQuantity = 0;
        $itemTotal = 0;
    
        foreach ($cart as $key => $item) {
            $productId = $item['product_id'];
            $quantity = $item['quantity'];
            $attributes = $item['attributes'];
    
            // Extract product price (assuming first attribute is price)
            $price = array_values($attributes)[0];
    
            // Calculate item total
            $total = $price * $quantity;
            $itemTotal += $total;
            $totalQuantity += $quantity;
    
            $products[] = $productId;
            $orderProducts[$productId] = [
                'quantity' => $quantity,
                'attributes' => $attributes,
                'price' => $price,
                'total' => $total,
            ];
        }
    
        // Fetch fees from a helper or predefined logic
        $fees = getAllFees($itemTotal);  // Replace with your fee calculation logic
    
        // Prepare order data
        $orderData = [
            'user_id' => auth()->id(),  // Assuming user is authenticated
            'cart' => json_encode($cart),
            'products' => json_encode($products),
            'order_products' => json_encode($orderProducts),
            'quantity' => $totalQuantity,
            'address' => auth()->user()->addresses->first()->id, 
            'order_number' => 'ORD-' . strtoupper(Str::random(5)) . '-' . now()->format('YmdHis') . '-' . auth()->id(),
            'tip' => $tip,
            'delivery_fee' => $fees['deliveryCharge']->fee,
            'discounted_delivery_fee' => $fees['deliveryCharge']->discounted_fee,
            'handling_fee' => $fees['handlingCharge']->fee,
            'discounted_handling_fee' => $fees['handlingCharge']->discounted_fee,
            'small_cart_fee' => $fees['smallOrderCharge']->fee,
            'discounted_small_cart_fee' => $fees['smallOrderCharge']->discounted_fee,
            'savings' => $fees['grandTotal']-$fees['discountedGrandTotal'],  // Define savings logic if applicable
            'coupon' => $request->input('coupon'),  // Fetch coupon from request
            // 'coupon_discounted' => $fees['couponDiscount']?$fees['couponDiscount']:0,
            'grand_total' => $fees['grandTotal'],
            'total_pay' => $fees['discountedGrandTotal'] + $tip,
        ];
    
        // Save order
        $order = Order::create($orderData);
    
    
        return view  ( 'frontend.user.orderplaced' , ['order_number'=>$order->order_number]);
    }
    
   


}
