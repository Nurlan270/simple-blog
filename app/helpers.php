<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;


if (!function_exists('mark_route')) {
    /**
     * Return 'active' if user is currently in route
     * or empty string if it's not
     *
     * @param string $route
     * @return string
     */
    function mark_route(string $route): string
    {
        return Route::is($route)
            ? 'active'
            : '';
    }
}

if (! function_exists('format_str')) {
    function format_str(string $str, ?int $length = null): string
    {
        if (isset($length)) {
            return Str::of(
                Str::limit(nl2br($str), $length)
            )->stripTags([  // Allowed characters
                'br',
                'p', 'b', 'em', 'pre', 'del', 'blockquote',
                'ul', 'ol', 'li', 'a'
            ]);

        } else {
            return Str::of($str)
            ->stripTags([  // Allowed characters
                'br',
                'p', 'b', 'em', 'pre', 'del', 'blockquote',
                'ul', 'ol', 'li', 'a'
            ]);
        }
    }
}
