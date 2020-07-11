<?php

namespace Codedor\LivewireForms\Fields;

use Closure;

abstract class Field
{
    public $containsFile = false;

    public function render()
    {
        if ($this->conditionalCheck()) {
            return view($this->component, [
                'field' => $this
            ]);
        }
    }

    public function __construct($name, $label = null)
    {
        $this->name = $name;
        $this->label = $label ?? ucfirst(str_replace('_', ' ', $name));
    }

    public static function make($name = '', $label = null)
    {
        return new static($name, $label);
    }

    public function __get($name)
    {
        return $this->{$name} ?? null;
    }

    public function __call($name, $value)
    {
        if ($value === []) {
            $this->{$name} = true;
        } else if (count($value) > 1) {
            $this->{$name} = $value;
        } else {
            $this->{$name} = optional($value)[0];
        }

        return $this;
    }

    public function getName()
    {
        $name = $this->name;

        if (isset($this->prefix)) {
            return "{$this->prefix}_{$name}";
        }

        if (isset($this->suffix)) {
            return "{$name}_{$this->suffix}";
        }

        return $name;
    }

    public function getValue($doConditionalChecks = false)
    {
        if ($doConditionalChecks && !$this->conditionalCheck()) {
            return $this->getDefaultValueOrNull();
        }

        return session(
            "form-fields.{$this->getName()}",
            $this->getDefaultValueOrNull()
        );
    }

    public function getDefaultValueOrNull()
    {
        return $this->default ?? $this->value ?? null;
    }

    public function conditionalCheck()
    {
        if (!$this->conditional) {
            return true;
        }

        if (optional($this->conditional)[1] instanceof Closure) {
            return call_user_func(
                $this->conditional[1],
                session("form-fields.{$this->conditional[0]}"),
                $this->conditional[0],
                optional(session('form-fields', []))
            );
        } else {
            if (gettype($this->conditional) === 'array') {
                return session("form-fields.{$this->conditional[0]}") === $this->conditional[1];
            } else {
                return session("form-fields.{$this->conditional}") === true;
            }
        }

        return false;
    }

}
