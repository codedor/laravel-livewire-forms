<?php

namespace Codedor\LivewireForms\Fields;

abstract class Field
{
    public function render()
    {
        return view($this->component, [
            'field' => $this
        ]);
    }

    public function __construct($name, $label = null)
    {
        $this->name = $name;
        $this->label = $label ?? ucfirst($name);
    }

    public static function make($name = '', $label = null)
    {
        return new static($name);
    }

    public function __get($name)
    {
        return $this->{$name} ?? null;
    }

    public function __call($name, $value)
    {
        $this->{$name} = ($value === [] ? true : optional($value)[0]);
        return $this;
    }

    public function fields()
    {
        return [$this];
    }

    public function prefix($prefix)
    {
        $this->prefix = $prefix;
        $this->name = $prefix . '_' . $this->name;
        return $this;
    }
}
