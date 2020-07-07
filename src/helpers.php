<?php

use PragmaRX\Countries\Package\Countries;


if (!function_exists('getCountryList')) {
    function getCountryList()
    {
        $countries =  Countries::all()
            ->pluck('name.common', 'cca2')
            ->sort();
        return $countries;
    }
}

if (!function_exists('getCountryName')) {
    function getCountryName($cca2)
    {
        $country =  Countries::where('cca2', $cca2)
            ->pluck('name.common')
            ->first();
        return $country;
    }
}