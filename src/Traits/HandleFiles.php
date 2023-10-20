<?php

namespace Codedor\LivewireForms\Traits;

use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

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
                    try {
                        $this->fields[$key][] = $_file->id;
                    } catch (ValidationException $e) {
                        $this->withValidator(function (Validator $validator) use ($key, $e) {
                            $validator->after(function ($validator) use ($key, $e) {
                                $validator->errors()->add('files.' . $key, $e->errors()[0][0]);
                            });
                        })->validate();
                    }
                }
            } else {
                // Single upload
                $field = $fileFields[$key] ?? [];
                try {
                    $file = $file->upload($field->disk ?? 'public');
                    $this->fields[$key] = $file->id;
                } catch (ValidationException $e) {
                    $this->withValidator(function (Validator $validator) use ($key, $e) {
                        $validator->after(function ($validator) use ($key, $e) {
                            $validator->errors()->add('files.' . $key, $e->errors()[0][0]);
                        });
                    })->validate();
                }
            }
        }

    }
}
