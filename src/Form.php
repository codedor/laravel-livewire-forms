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

    public static function fieldStack($stack = null): array
    {
        $fields = collect([]);
        collect($stack ?? static::fields())
            ->each(function($field) use (&$fields) {
                $fields = $fields->merge($field->fields());
            });

//         $noMoreFields = false;
//         $interger = false;
//         while (!$noMoreFields)
// dd($fields);
        return $fields->toArray();
    }

    public static function validation($stack = null): array
    {
        $rules = collect([]);
        $fields = $stack ?? collect(static::fieldStack());

        $fields->filter(function($value) {
                return (optional($value)->isField !== false);
            })
            ->each(function($value) use (&$rules) {
                if ($value->containsFile) {
                    $rules->put('files.' . $value->name, $value->rules ?? '');
                } else {
                    $rules->put('fields.' . $value->name, $value->rules ?? '');
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
