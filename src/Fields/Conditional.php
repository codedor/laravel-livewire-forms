<?php

namespace Codedor\LivewireForms\Fields;

class Conditional extends Field
{
    public $component = 'livewire-forms::fields.conditional';
    public $checkField;
    public $checkValue;

    public function __construct($checkField, $checkValue, $hiddenFields = null)
    {
        $this->checkField = $checkField;
        $this->checkValue = $checkValue;
        $this->hiddenFields = $hiddenFields;
    }

    public static function make($checkField = '', $checkValue = true, $hiddenFields = null)
    {
        return new static($checkField, $checkValue, $hiddenFields);
    }

    public function fields()
    {
        $fields = collect([]);

        collect($this->hiddenFields)
            ->each(function($value) use (&$fields) {
                $fields->push($value->fields());
            });

        return $fields->flatten();
    }
}
