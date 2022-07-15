<?php

namespace Codedor\LivewireForms\Fields;

use Codedor\Media\Models\Attachment;

class ImageField extends Field
{
    public $component = 'livewire-forms::fields.image';

    public $value = false;

    public $containsFile = true;

    public function getValue($doConditionalChecks = false)
    {
        $value = parent::getValue($doConditionalChecks);

        if ($value === '') {
            return $value;
        }

        if (Attachment::find($value)) {
            return Attachment::find($value)->getFormatOrOriginal($this->format ?? '');
        }

        return $value;
    }
}
