<?php

namespace Codedor\LivewireForms;

use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormController extends Component
{
    use WithFileUploads;

    public $component;
    public $form;
    public $locale;
    public $model;
    public $savedModel;

    public $fields = [];
    public $validation = [];
    public $step;

    public function hydrate()
    {
        // Important for translated values
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
                return [optional($value)->name => optional($value)->value ?? ''];
            })
            ->toArray();
    }

    public function getFields()
    {
        return collect($this->form::fieldStack())
            ->filter(function($value) {
                return (optional($value)->isField !== false);
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

        return view($this->component ?? 'livewire.forms.form');
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

    public function submit()
    {
        // Validate
        $this->validateData();

        // Parse special fields
        foreach ($this->getFields() as $field) {
            if (method_exists($this, 'parse' . Str::studly($field->name))) {
                $this->{'parse' . Str::studly($field->name)}();
            }
        }

        // Save the model
        $this->saveData();

        // Success message
        $this->successMessage();

        // Do other things, like mails
        $this->afterSubmit();

        // Reset form
        $this->resetForm();
    }

    public function validateStep($step = null)
    {
        $validation = $this->form::stepValidation($step ?? $this->step);
        $this->validate($validation);
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
