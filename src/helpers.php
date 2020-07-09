<?php

use Illuminate\Support\Facades\Cache;
use PragmaRX\Countries\Package\Countries;

if (!function_exists('getCountryList')) {
    function getCountryList()
    {
        return Cache::rememberForever('form_countries', function () {
            return Countries::all()
                ->pluck('name.common', 'cca2')
                ->sort();
        });
    }
}

if (!function_exists('getCountryName')) {
    function getCountryName($cca2)
    {
        return Cache::rememberForever('form_countries_' . $cca2, function () use ($cca2) {
            return Countries::where('cca2', $cca2)
                ->pluck('name.common')
                ->first();
        });
    }
}
