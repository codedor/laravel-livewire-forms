<?php

namespace Codedor\LivewireForms\Fields;

class Step extends Field
{
    public $component = 'livewire-forms::fields.step';

    public function getNestedFields()
    {
        $fields = collect([]);

        collect($this->fields)
            ->each(function($value) use (&$fields) {
                $fields->push($value->getNestedFields());
            });

        return $fields->flatten();
    }
}
