<?php

if (!function_exists('isActive')) {
    function isActive(array|string $patterns, string $output = 'active'): string
    {
        foreach ((array) $patterns as $pattern) {
            if (request()->routeIs($pattern)) {
                return $output;
            }
        }
        return '';
    }
}
