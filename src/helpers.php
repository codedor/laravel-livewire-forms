<?php

use Illuminate\Support\Collection;
use PeterColes\Countries\CountriesFacade;

if (! function_exists('getCountryList')) {
    function getCountryList(bool $reverse = false): Collection
    {
        return CountriesFacade::lookup(app()->getLocale(), $reverse)
            ->sort();
    }
}

if (! function_exists('getCountryName')) {
    function getCountryName(string $code)
    {
        return getCountryList()
            ->get($code);
    }
}

if (! function_exists('getCountryCode')) {
    function getCountryCode(string $name)
    {
        return getCountryList(true)
            ->get($name);
    }
}
