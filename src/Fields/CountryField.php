<?php

namespace Codedor\LivewireForms\Fields;

class CountryField extends Field
{
    public $options = getCountryList();
    public $component = 'livewire-forms::fields.select';
}
