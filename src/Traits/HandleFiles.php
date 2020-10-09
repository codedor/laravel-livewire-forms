<?php

namespace Codedor\LivewireForms\Traits;

trait HandleFiles
{
    public $files = [];

    public function saveUploadedFiles($step = null)
    {
        $fileFields = $step
            ? $this->getForm()->stepFileFieldStack($step)
            : $this->getForm()->fileFieldStack();

        // Set it to null, otherwise it's an empty string
        foreach (array_keys($fileFields) as $key) {
            $this->fields[$key] = null;
        }

        foreach ($this->files ?? [] as $key => $file) {
            if (is_array($file)) {
                // Multi upload
                foreach ($file as $value) {
                    $field = $fileFields[$key] ?? [];
                    $_file = $value->upload($field->disk ?? 'public');
                    $this->fields[$key][] = $_file->id;
                }
            } else {
                // Single upload
                $field = $fileFields[$key] ?? [];
                $file = $file->upload($field->disk ?? 'public');
                $this->fields[$key] = $file->id;
            }
        }
    }
}
