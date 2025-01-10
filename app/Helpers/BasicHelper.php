<?php

use Jenssegers\Agent\Facades\Agent;
use Illuminate\Support\Facades\DB;

if (!function_exists('getLayout')) {
    /**
     * Get the appropriate layout based on the device type.
     *
     * @return string
     */
    function getLayout(): string
    {
        return Agent::isMobile() ? 'layouts.mobile' : 'layouts.front';
    }
}

if (!function_exists('getDiscount')) {
    /**
     * Calculate the discount percentage for a product.
     *
     * @param  \App\Models\Product $product
     * @return int
     */
    function getDiscount($product) {
        $discount = $product->mrp - $product->price;
        if ($product->mrp > 0) {
            $discountPercentage = ($discount / $product->mrp) * 100;
            return round($discountPercentage);
        } else {
            return 0;
        }
    }
}

if (!function_exists('getAllFees')) {
    /**
     * Get all fees (delivery, handling, small order) and calculate totals.
     *
     * @param  float $orderTotal
     * @return array
     */
    function getAllFees($orderTotal) {
        // Fetch all fee details from the database
        $deliveryCharge = getDeliveryCharge($orderTotal);
        $handlingCharge = getHandlingCharge($orderTotal);
        $smallOrderCharge = getSmallOrderCharge($orderTotal);
        
        // Example logic for a 10% discount
        $discountedFee = 0; // Example: 10% discount
        
        // Return all fees and totals
        return [
            'itemTotal' => $orderTotal,
            'deliveryCharge' => $deliveryCharge,
            'handlingCharge' => $handlingCharge,
            'smallOrderCharge' => $smallOrderCharge,
            'discountedFee' => $discountedFee,
            'grandTotal' => $orderTotal + $deliveryCharge->fee + $handlingCharge->fee + $smallOrderCharge->fee,
            'discountedGrandTotal' =>$orderTotal + $deliveryCharge->discounted_fee + $handlingCharge->discounted_fee + $smallOrderCharge->discounted_fee
        ];
    }
}

if (!function_exists('getDeliveryCharge')) {
    /**
     * Get the delivery charge based on the order total.
     *
     * @param  float $orderTotal
     * @return float
     */
    function getDeliveryCharge($orderTotal) {
        // Fetch the applicable delivery fee from the 'delivery_fees' table
        $deliveryFee = DB::table('deliveryfee')
            ->where('status', 1) // Ensure it's active
            ->where('min_order_value_start', '<=', $orderTotal)
            ->where('max_order_value_end', '>=', $orderTotal)
            ->first();

        return $deliveryFee ? $deliveryFee : 50; // Default to ₹50 if not found
    }
}

if (!function_exists('getHandlingCharge')) {
    /**
     * Get the handling charge for the order.
     *
     * @param  float $orderTotal
     * @return float
     */
    function getHandlingCharge($orderTotal) {
        // Fetch the applicable handling fee from the 'handling_fees' table
        $handlingFee = DB::table('handling_fee')
            ->where('status', 1)  // Ensure it's active
            ->where('min_order_value_start', '<=', $orderTotal)
            ->where('max_order_value_end', '>=', $orderTotal)
            ->first();

        return $handlingFee ? $handlingFee : 20; // Default to ₹20 if not found
    }
}

if (!function_exists('getSmallOrderCharge')) {
    /**
     * Get the small order charge for orders below ₹100.
     *
     * @param  float $orderTotal
     * @return float
     */
    function getSmallOrderCharge($orderTotal) {
        // Fetch the applicable small order fee from the 'small_cart_fees' table
        $smallCartFee = DB::table('small_cart_fee')
            ->where('status', 1)  // Ensure it's active
            ->where('min_order_value_start', '<=', $orderTotal)
            ->where('max_order_value_end', '>=', $orderTotal)
            ->first();

        return $smallCartFee ? $smallCartFee : 0; // Default to ₹0 if not found
    }
}
