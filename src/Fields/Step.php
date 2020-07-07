<?php

namespace Codedor\LivewireForms\Fields;

class Step extends Field
{
    public $component = 'livewire-forms::fields.step';

    public $step;
    public $title;
    public $fields;

    public function __construct($step, $title, $fields = [])
    {
        $this->step = $step;
        $this->title = $title;
        $this->fields = $fields;
    }

    public static function make($step = '', $title = null, $fields = [])
    {
        return new static($step, $title, $fields);
    }

    public function fields()
    {
        $fields = collect([]);

        collect($this->fields)
            ->each(function($value) use (&$fields) {
                $fields->push($value->fields());
            });

        return $fields->flatten();
    }
}
