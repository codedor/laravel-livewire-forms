<?php

namespace Codedor\LivewireForms;

use Livewire\Component;
use Livewire\WithFileUploads;

class FormController extends Component
{
    use WithFileUploads;

    public $component;
    public $fields;
    public $files;
    public $form;
    public $locale;
    public $model;
    public $savedModel;
    public $step;

    public $validation = [];

    public $casts = [
        'fields' => 'collection'
    ];

    public function hydrate()
    {
        // Important for translated values (ex.: in select fields)
        app()->setLocale($this->locale);
    }

    public function mount($form, $model = null, $component = null)
    {
        session()->remove('step');
        session()->remove('formFields');

        $this->form = $form;
        $this->model = $model;
        $this->component = $component;
        $this->locale = app()->getLocale();
        $this->validation = $this->form::validation();
        $this->step = 1;

        // Get fields and default values
        $this->fields = $this->getFields()
            ->mapWithKeys(function($value) {
                $value = optional($value);
                return [$value->name => $value->value ?? $value->default ?? ''];
            });
    }

    public function getFields()
    {
        return collect($this->form::fieldStack())
            ->filter(function($value) {
                return (optional($value)->isField !== false);
            });
    }

    public function getFileFields()
    {
        return $this->getFields()
            ->filter(function($value) {
                return $value->containsFile;
            })
            ->mapWithKeys(function ($value) {
                return [$value->name => $value];
            });
    }

    public function updated($field)
    {
        $this->validateOnly($field, $this->validation);
    }

    public function render()
    {
        session()->put('step', $this->step);
        session()->put('formFields', $this->fields);

        return view($this->component ?? 'livewire-forms::form');
    }

    public function nextStep()
    {
        $this->validateStep();
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function goToStep($index)
    {
        if ($index <= $this->step) {
            $this->step = $index;
        }
    }

    public function validateStep($step = null)
    {
        $validation = $this->form::stepValidation($step ?? $this->step);
        $this->validate($validation);
    }

    public function submit()
    {
        // Parse special fields
        $this->beforeSubmit();

        // Validate
        $this->validateData();

        // Save uploaded files
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

    public function validateData()
    {
        $this->validate($this->validation);
    }

    public function beforeSubmit()
    {
        //
    }

    public function saveUploadedFiles()
    {
        $fileFields = $this->getFileFields();

        foreach ($this->files as $key => $file) {
            $field = $fileFields[$key] ?? [];
            $file = $file->upload($field->disk ?? 'public');
            $this->fields[$key] = $file->id;
        }
    }

    public function saveData()
    {
        if ($this->model) {
            $fields = $this->fields->toArray();
            $this->savedModel = $this->model::create($fields);
        }
    }

    public function resetForm()
    {
        $this->mount($this->form, $this->model, $this->component);
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
