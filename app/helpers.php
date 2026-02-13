<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('isActive')) {
    function isActive($routeName)
    {
        return Route::currentRouteNamed($routeName) ? 'active' : '';
    }
}

if (!function_exists('isActives')) {
    function isActives($routes)
    {
        return request()->routeIs($routes) ? 'active' : '';
    }
}

if (!function_exists('isShow')) {
    function isShow($routes)
    {
        return request()->routeIs($routes) ? 'show' : '';
    }
}
