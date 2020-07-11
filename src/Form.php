<?php

namespace Codedor\LivewireForms;

abstract class Form
{
    abstract public static function fields();

    /**
     * Return only the fields and nested fields (without Row, Group, ...)
     * @param boolean $doConditionalChecks  Return all the fields, or filter them on conditionals
     * @param array   $stack                Return the fieldStack of a stack of fields
     */
    public static function fieldStack($doConditionalChecks = false, $stack = null): array
    {
        $fields = collect([]);
        collect($stack ?? static::fields())
            ->each(function ($field) use (&$fields) {
                if (!isset($field->isField)) {
                    $fields = $fields->merge(static::getFieldStackFromField($field));
                }
            });

        if ($doConditionalChecks) {
            $fields = $fields->filter(function ($field) {
                return $field->conditionalCheck();
            });
        }

        return $fields->toArray();
    }

    public static function getFieldStackFromField($field)
    {
        $return = collect([]);
        if (isset($field->fields)) {
            foreach ($field->fields() as $field) {
                if (!isset($field->isField)) {
                    $return->push(static::getFieldStackFromField($field));
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
    public static function validation($stack = null): array
    {
        $rules = collect([]);
        $fields = $stack ?? collect(static::fieldStack());

        $fields->each(function($value) use (&$rules) {
            if ($value->containsFile) {
                $rules->put('files.' . $value->getName(), $value->rules ?? '');
            } else {
                $rules->put('fields.' . $value->getName(), $value->rules ?? '');
            }
        });

        return $rules->toArray();
    }

    public static function stepValidation($step): array
    {
        $fields = collect(static::fields())
            ->filter(function($value) use ($step) {
                return $value->step === $step;
            })
            ->first()
            ->fields;

        return static::validation(
                collect(static::fieldStack(true, $fields))
            );
    }

    // Get the file fields
    public static function fileFieldStack()
    {
        dd(static::fieldStack());
    }
}
