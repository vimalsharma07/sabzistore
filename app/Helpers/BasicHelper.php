<?php

use Jenssegers\Agent\Facades\Agent;

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
