<?php
/**
 * Helper function overall project as global
 */


if (!function_exists('isActiveMenu')) {

    /**
     * Active who is a menu by url
     *
     * @param string|array $routeName
     * @return void
     */
    function isActiveMenu(string|array $routeName)
    {
        $currentRoute = Route::current()->getName();

        $printClass = 'true';

        if (is_array($routeName)) {
            echo in_array($currentRoute, $routeName) ? $printClass : 'false';
            return;
        }

        echo Route::current()->getName() === $routeName ? $printClass : 'false';
    }
}
