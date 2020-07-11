<?php

namespace Codedor\LivewireForms\Fields;

class Group extends Field
{
    public $component = 'livewire-forms::fields.group';

    public $groupVariables = [];

    public function __construct($fields = '', $label = null)
    {
        $this->fields = $fields;
    }

    public static function make($fields = '', $label = null)
    {
        return new static($fields);
    }

    public function fields()
    {
        $this->passVariables($this->fields);
        return $this->fields;
    }

    public function groupFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    public function __call($name, $value)
    {
        parent::__call($name, $value);
        $this->groupVariables[$name] = $this->{$name};
        return $this;
    }

    public function passVariables(&$fields)
    {
        if (gettype($fields) === 'array') {
            foreach ($fields as &$field) {
                if (isset($field->fields)) {
                    $this->passVariables($field->fields);
                } else {
                    foreach ($this->groupVariables as $key => $value) {
                        if (!isset($field->{$key})) {
                            $field->{$key} = $value;
                        }
                    }
                }
            }
        }
    }
}
