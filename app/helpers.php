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


if (!function_exists('get_setting')) {
    function get_setting($key, $default = null)
    {
        return cache()->remember("setting_$key", 3600, function () use ($key, $default) {
            $setting = \App\Models\Setting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }
}
