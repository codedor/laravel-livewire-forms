<?php

namespace Codedor\LivewireForms\Traits;

use Codedor\LivewireForms\Fields\Field;
use Illuminate\Support\Str;

trait HandleSubmit
{
    public function submit()
    {
        // Parse special fields
        $this->beforeSubmit();

        // Validate
        $this->validateData();

        // Set the fields a final time, with conditional checks
        $this->setFinalFields();

        // Save uploaded files (HandleFiles trait)
        $this->saveUploadedFiles();

        // Save the model
        $this->saveData();

        // Success message
        $this->successMessage();

        // Do other things, like mails
        $this->afterSubmit();

        // Reset form
        $this->resetForm();
    }

    public function beforeSubmit()
    {
        //
    }

    public function validateData()
    {
        $this->setValidation();
        $this->validate($this->validation);
    }

    public function setFinalFields()
    {
        $this->fields = [];
        $this->fieldStack = $this->getForm()->fieldStack(false);
        $this->setFields();

        $this->fields = collect($this->fields)
            ->mapWithKeys(function ($value, $key) {
                return [Str::afterLast($key, '.') => $value];
            })
            ->toArray();
    }

    public function saveData()
    {
        if ($this->modelClass) {
            $this->savedModel = $this->modelClass::create($this->fields);
        }
    }

    public function resetForm()
    {
        $this->mount($this->component);
    }

    public function successMessage()
    {
        session()->flash('message', __('form.success message'));
    }

    public function afterSubmit()
    {
        //
    }

}
