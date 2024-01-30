# UPGRADING

## From v4 to v5

We replaced `<div class="livewire-form">` with `<div class="livewire-form">` to prevent duplicate ids. The config has been updated so make sure all default options are present. `checkbox-group` has been added and `radio` has been renamed to `radio-group` to make it more consistent.

## From v2 to v3

We replaced pragmarx/countries by petercoles/multilingual-country-list, since pragmarx/countries was not compatible with Laravel 9.
But if you have not overridden the country field or helpers nothing is needed for this upgrade.
