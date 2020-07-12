<?php

namespace Codedor\LivewireForms;

use Codedor\LivewireForms\Traits\HandleSubmit;
use Codedor\LivewireForms\Traits\HasSteps;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormController extends Component
{
    use WithFileUploads,
        HandleSubmit,
        HasSteps;

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

    public function mount($component = null)
    {
        $this->locale = $this->locale ?? app()->getLocale();
        $this->component = $component ?? 'livewire-forms::form-steps';
        $this->setValidation();

        // if ($this->saveHistory) {
        session()->remove('form-fields');
        // }
    }

    public function render()
    {
        $this->setFields();
        $this->setValidation();

        session()->put('form-fields', $this->fields);
        View::share('step', $this->step);

        return view($this->component);
    }

    public function updated($field)
    {
        $this->validateOnly($field, $this->validation);
    }

    // Get and set the fields and the values
    public function setFields()
    {
        session()->put('form-fields', $this->fields);

        // Get every field without conditional checks
        collect($this->form::fieldStack(false))
            ->each(function ($field) {
                // Get value with conditional checks
                $this->fields[$field->getName()] = $field->getValue(true);
            });
    }

    // Get and set the validation rules
    public function setValidation()
    {
        $this->validation = $this->form::validation();
    }
}
