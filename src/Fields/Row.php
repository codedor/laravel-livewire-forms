<?php

namespace Codedor\LivewireForms\Fields;

class Row extends Field
{
    public $component = 'livewire-forms::fields.row';

    public function __construct($fields = '', $label = null)
    {
        $this->fields = $fields;
        $this->label = $label ?? '';
    }

    public static function make($fields = '', $label = null)
    {
        return new static($fields);
    }

    public function fields()
    {
        return $this->fields;
    }
}
