<?php

namespace Codedor\LivewireForms\Fields;

class CountryField extends Field
{
    public $component = 'livewire-forms::fields.select';
    public $options = [];

    public function __construct($name, $label = null)
    {
        parent::__construct($name, $label = null);
        $this->options = getCountryList();
    }
}