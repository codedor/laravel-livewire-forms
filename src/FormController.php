<?php

namespace Codedor\LivewireForms;

use Codedor\LivewireForms\Traits\HandleFiles;
use Codedor\LivewireForms\Traits\HandleSteps;
use Codedor\LivewireForms\Traits\HandleSubmit;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormController extends Component
{
    use HandleFiles,
        HandleSteps,
        HandleSubmit,
        WithFileUploads;

    public $form;
    public $model;

    public $locale = null;
    public $component;
    public $fields = [];
    public $validation = [];
    // public $saveHistory = false;

    public function hydrate()
    {
        // Important for translated values (ex.: in select fields)
        app()->setLocale($this->locale);
    }

    public function mount($component = null, $form = null)
    {
        $this->form = $this->form ?? $form;
        $this->locale = $this->locale ?? app()->getLocale();
        $this->component = $component ?? 'livewire-forms::form-steps';
        $this->setValidation();

        // if ($this->saveHistory) {
        session()->remove('step');
        session()->remove('form-fields');
        // }
    }

    public function render()
    {
        session()->put('step', $this->step);
        session()->put('form-fields', $this->fields);

        $this->setFields();
        $this->setValidation();

        return view($this->component);
    }

    public function updated($field)
    {
        $this->validateOnly($field, $this->validation);
    }

    // Get and set the fields and the values
    public function setFields($doCheck = true)
    {
        collect($this->form::fieldStack($doCheck))
            ->each(function ($field) use ($doCheck) {
                if (!$doCheck || $field->conditionalCheck()) {
                    $this->fields[$field->getName()] = $field->getValue();
                }
            });

        $this->fields['locale'] = $this->locale;
    }

    // Get and set the validation rules
    public function setValidation()
    {
        $this->validation = $this->form::validation();
    }
}
