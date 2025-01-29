<?php

namespace App\Http\Controllers\Front;
use PDF;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class OrderController extends Controller
{

    public function allorders(){
      $orders=   Order::where('user_id',Auth::user()->id)->get();
        return view('frontend.user.orders',['orders'=>$orders]);
    }

    
    public function index()
    {
        $orders = Order::with('address')->get(); // Assuming 'address' is a relation
        return response()->json($orders); // Return orders as JSON
    }

    public function reorder(Request $request, $order_number)
    {
        
        
        // Example placeholder for reorder logic
        $order = Order::where('order_number', $order_number)->first();
        if ($order) {
            // Copy order and save as new (customize this as per business logic)
            $newOrder = $order->replicate();
            $newOrder->created_at = now();
            $newOrder->order_status = 'Pending';
            $newOrder->save();

        }
        session()->forget('cart');  // or session()->flush(); to clear all session data

        return view  ( 'frontend.user.orderplaced' , ['order_number'=>$newOrder->order_number]);
    }

    public function downloadInvoice($id)
    {
        $order = Order::findOrFail($id);
    
        // Set the directory where the file will be saved
        $directory = public_path('assets/orders');
        
        // Check if directory exists, if not, create it
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);  // Ensure it is writable
        }
    
        // Define a unique file name to avoid overwriting
        $fileName = 'invoice_' . $order->order_number . '_' . time() . '.pdf';
        $filePath = $directory . '/' . $fileName;
    
        try {
            // Load the HTML view and generate PDF
            $pdf = \PDF::loadView('frontend.user.invoice', ['order' => $order])
                ->setPaper('A4', 'portrait')
                ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true, 'isUtf8Enabled' => true]);
    
            // Save the generated PDF file
            $pdf->save($filePath);
    
            // Return the file as a download response
            return response()->download($filePath);
    
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json(['error' => 'Failed to generate invoice. Please try again.'], 500);
        }
    }
    
    
    public function orderView(Request $request, $order_number){
     $order=  Order::with('address')->where('order_number',$order_number)->first();
     return view  ( 'frontend.user.order' , ['order'=>$order]);
    }

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
            $product=  $item['product'];
            $quantity = $item['quantity'];
            $attributes = $item['attributes'];
            $product->attributes= $attributes;
            $product->quantity= $quantity;
            // Extract product price (assuming first attribute is price)
            $price = array_values($attributes)[0];
            $product->price= $price;
            // Calculate item total
            $total = $price * $quantity;
            $itemTotal += $total;
            $totalQuantity += $quantity;
    
            $products[] = $product;
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
    
        session()->forget('cart');  // or session()->flush(); to clear all session data

        return view  ( 'frontend.user.orderplaced' , ['order_number'=>$order->order_number]);
    }
    
    public function getOrders(Request $request, $order_status){
     $orders=    Order::where('user_id',Auth::user()->id)->where('order_status',$order_status)->get();
     return view('frontend.user.orders',['orders'=>$orders]);

    }


}
