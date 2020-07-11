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

        // Save uploaded files
        // $this->saveUploadedFiles();

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

    public function saveUploadedFiles()
    {
        $fileFields = $this->form::fileFieldStack();

        // Set it to null, otherwise it's an empty string
        foreach (array_keys($fileFields->toArray()) as $key) {
            $this->fields[$key] = null;
        }

        foreach ($this->files ?? [] as $key => $file) {
            $field = $fileFields[$key] ?? [];
            $file = $file->upload($field->disk ?? 'public');
            $this->fields[$key] = $file->id;
        }
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
