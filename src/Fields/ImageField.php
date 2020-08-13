<?php

namespace Codedor\LivewireForms\Fields;

use Codedor\LinkPicker\LinkPickerRoute;
use Codedor\Media\Models\Attachment;

class ImageField extends Field
{
    public $component = 'livewire-forms::fields.image';

    public $value = false;

    public function getValue($doConditionalChecks = false)
    {
        $value = parent::getValue($doConditionalChecks);

        if ($value === '') {
            return $value;
        }

        if (Attachment::find($value)) {
            return Attachment::find($value);
        }

        return $value;
    }

    public function isJson($value)
    {
        json_decode($value);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
