<?php

namespace Codedor\LivewireForms\Fields;

class Conditional extends Field
{
    public $component = 'livewire-forms::fields.conditional';

    public function __construct($checkField, $checkValue, $trueFields = [], $falseFields = [])
    {
        $this->checkField = $checkField;
        $this->checkValue = $checkValue;
        $this->trueFields = $trueFields;
        $this->falseFields = $falseFields;
    }

    public static function make(
        $checkField = '',
        $checkValue = true,
        $trueFields = [],
        $falseFields = []
    ) {
        return new static($checkField, $checkValue, $trueFields, $falseFields);
    }

    public function fields()
    {
        $fields = collect([]);

        collect($this->getFields())
            ->each(function($value) use (&$fields) {
                $fields->push($value->fields());
            });

        return $fields->flatten();
    }

    public function getFields()
    {
        return (
            ($this->checkValue())
                ? $this->trueFields
                : $this->falseFields
            ) ?? [];
    }

    public function checkValue()
    {
        return session("form-fields.{$this->checkField}") === $this->checkValue;
    }
}
