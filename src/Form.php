<?php

namespace Codedor\LivewireForms;

use Codedor\LivewireForms\Fields\Field;

abstract class Form
{
    public $fields = null;

    abstract public function fields();

    public function __construct()
    {
        $this->fields = $this->fields();
    }

    /**
     * Return only the fields and nested fields (without Row, Group, ...)
     * @param boolean $doConditionalChecks  Return all the fields, or filter them on conditionals
     * @param array   $stack                Return the fieldStack of a stack of fields
     */
    public function fieldStack($doConditionalChecks = false, $stack = null): array
    {
        $fields = collect([]);
        collect($stack ?? $this->fields ?? $this->fields())
            ->each(function ($field) use (&$fields) {
                if (!isset($field->isField)) {
                    $fields = $fields->merge($this->getFieldStackFromField($field));
                }
            });

        if ($doConditionalChecks) {
            $fields = $fields->filter(function ($field) {
                return $field->conditionalCheck();
            });
        }

        return $fields->toArray();
    }

    public function getFieldStackFromField(Field $field)
    {
        $return = collect([]);
        if (isset($field->fields)) {
            foreach ($field->getNestedFields() as $field) {
                if (!isset($field->isField)) {
                    $return->push($this->getFieldStackFromField($field));
                }
            }
        } else {
            if (!isset($field->isField)) {
                $return->push($field);
            }
        }

        return $return->flatten();
    }

    // Get the validation rules
    public function validation($stack = null, $skipChecks = false): array
    {
        $rules = collect([]);
        $fields = $stack ?? collect($this->fieldStack());

        $fields->each(function(Field $value) use (&$rules, $skipChecks) {
            if ($skipChecks || $value->conditionalCheck()) {
                if ($value->containsFile) {
                    $rules->put('files.' . $value->getName(), $value->rules ?? '');
                } else {
                    $rules->put('fields.' . $value->getName(), $value->rules ?? '');
                }
            }
        });

        return $rules->toArray();
    }

    public function stepValidation($step): array
    {
        $fields = collect($this->fields())
            ->filter(function($value) use ($step) {
                return $value->step === $step;
            })
            ->first();

        $fields = $this->getFieldStackFromField($fields);

        return $this->validation(
                collect($this->fieldStack(true, $fields))
            );
    }

    // Get the file fields
    public function fileFieldStack()
    {
        $fields = [];
        collect($this->fieldStack())
            ->each(function ($value) use (&$fields) {
                if ($value->containsFile) {
                    $fields[$value->getName()] = $value;
                }
            });

        return $fields;
    }
}
