<?php

it('returns a collection of countries')
    ->expect(fn() => getCountryList())
    ->toBeIterable()
    ->toHaveKey('BE', 'Belgium');

it('returns a translated collection of countries', function () {
    app()->setLocale('nl');

    expect(getCountryList())
        ->toBeIterable()
        ->toHaveKey('BE', 'België');
});

it('can return a name')
    ->expect(fn () => getCountryName('BE'))
    ->toBe('Belgium');

it('can return a code')
    ->expect(fn () => getCountryCode('Belgium'))
    ->toBe('BE');
