<?php

namespace Codedor\LivewireForms\Fields;

use Closure;

class SelectField extends Field
{
    public $component = 'livewire-forms::fields.select';

    public $options = [];

    public $value = '';

    public $nullable = false;

    public $localString = '';

    public function options($options)
    {
        if ($options instanceof Closure) {
            $this->options = call_user_func($options, optional(session('form-fields', [])));
        } else {
            $this->options = $options;
        }

        return $this;
    }

    public function nullable($localString = null, $nullable = true)
    {
        $this->nullable = $nullable;
        $this->localString = $localString ?? __('form.select an option');
        return $this;
    }
}
