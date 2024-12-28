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
}
