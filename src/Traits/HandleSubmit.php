<?php

namespace Codedor\LivewireForms\Traits;

trait HandleSubmit
{
    public function submit()
    {
        // Parse special fields
        $this->beforeSubmit();

        // Validate
        $this->validateData();

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
        $this->validate($this->validation);
    }

    public function saveData()
    {
        if ($this->model) {
            $this->savedModel = $this->model::create($this->fields);
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
