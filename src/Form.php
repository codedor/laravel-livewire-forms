<?php

namespace Codedor\LivewireForms;

abstract class Form
{
    abstract public static function fields();

    public static function getFields()
    {
        $fields = collect(static::fields());
        foreach ($fields as &$field) {
            $field = $field->fields();
        }

        return $fields;
    }

    // Return only the fields and nested fields (without Row, Group, ...)
    public static function fieldStack($stack = null): array
    {
        $fields = collect([]);
        collect($stack ?? static::fields())
            ->each(function($field) use (&$fields) {
                $fields = $fields->merge(self::getFieldStackFromField($field));
            });

        return $fields->toArray();
    }

    public static function getFieldStackFromField($field)
    {
        $return = collect([]);
        if (isset($field->fields)) {
            foreach ($field->fields() as $field) {
                $return->push(self::getFieldStackFromField($field));
            }
        } else {
            $return->push($field);
        }

        return $return->flatten();
    }

    public static function validation($stack = null): array
    {
        $rules = collect([]);
        $fields = $stack ?? collect(static::fieldStack());

        $fields->filter(function($value) {
                return (optional($value)->isField !== false);
            })
            ->filter(function($field) {
                return $field->checkConditional();
            })
            ->each(function($value) use (&$rules) {
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
                collect(static::fieldStack($fields))
            );
    }
}
