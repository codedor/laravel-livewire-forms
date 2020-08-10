<?php

namespace Codedor\LivewireForms\Traits;

trait HandleFiles
{
    public $files = [];

    public function saveUploadedFiles($step = null)
    {
        $fileFields = $step ? $this->getForm()->stepFileFieldStack($step)
            : $this->getForm()->fileFieldStack();
        // Set it to null, otherwise it's an empty string
        foreach (array_keys($fileFields) as $key) {
            $this->fields[$key] = null;
        }

        foreach ($this->files ?? [] as $key => $file) {
            $field = $fileFields[$key] ?? [];
            $file = $file->upload($field->disk ?? 'public');
            $this->fields[$key] = $file->id;
        }
    }
}
