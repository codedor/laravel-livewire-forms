<?php

namespace Codedor\LivewireForms;

use Codedor\LivewireForms\Fields\Field;
use Codedor\LivewireForms\Traits\HandleFiles;
use Codedor\LivewireForms\Traits\HandleSteps;
use Codedor\LivewireForms\Traits\HandleSubmit;
use Exception;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormController extends Component
{
    use HandleFiles,
        HandleSteps,
        HandleSubmit,
        WithFileUploads;

    public $formClass;
    public $modelClass;

    public $locale = null;
    public $component;
    public $fields = [];
    public $validation = [];
    public $uniqueFormId;
    // public $saveHistory = false;

    protected $fieldStack = [];
    protected $form = null;

    public function hydrate()
    {
        // Important for translated values (ex.: in select fields)
        app()->setLocale($this->locale);
    }

    public function mount($component = null, $formClass = null)
    {
        $this->formClass = $formClass ?? $this->formClass;
        $this->locale = $this->locale ?? app()->getLocale();
        $this->component = $component ?? 'livewire-forms::form';

        if (!$this->formClass) {
            throw new Exception('Did not pass a $formClass in the FormController or blade file.');
        }
    }

    public function render()
    {
        session()->put('form-fields', $this->fields);
        session()->put('step', $this->step);

        session()->remove('livewire-form.field-counter');
        $this->form = $this->getForm();
        $this->fieldStack = $this->form->fieldStack(false);

        $this->setFields();
        $this->setValidation();

        View::share('files', $this->files);
        View::share('fields', $this->fields);

        return view($this->component, [
            'form' => $this->form
        ]);
    }

    public function updated($field)
    {
        $this->setValidation();
        $this->validateOnly($field, $this->validation);
    }

    // Get and set the fields and the values
    public function setFields($doCheck = true)
    {
        collect($this->fieldStack)
            ->each(function (Field $field) use ($doCheck) {
                if (!$doCheck || $field->conditionalCheck()) {
                    $this->fields[$field->getName()] = $field->getValue();
                }
            });

        $this->fields['locale'] = $this->locale;
    }

    // Get and set the validation rules
    public function setValidation()
    {
        $this->validation = $this->getForm()->validation();
    }

    public function getForm()
    {
        return (new $this->formClass);
    }
}
