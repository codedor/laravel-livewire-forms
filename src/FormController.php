<?php

namespace Codedor\LivewireForms;

use Codedor\LivewireForms\Fields\Field;
use Codedor\LivewireForms\Traits\HandleFiles;
use Codedor\LivewireForms\Traits\HandleSteps;
use Codedor\LivewireForms\Traits\HandleSubmit;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
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
    public $syncs = [];
    public $flashes = [];

    protected $form = null;
    protected $fieldStack = [];

    public function hydrate()
    {
        // Important for translated values (ex.: in select fields)
        app()->setLocale($this->locale);
    }

    public function mount(?string $component = null, ?string $formClass = null)
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

        $this->form = $this->getForm();
        $this->fieldStack = $this->form->fieldStack(false);

        $this->setFields();
        $this->setValidation();

        $this->checkFiles();

        View::share('files_', $this->files);
        View::share('fields_', $this->fields);
        View::share('flashes', $this->flashes);

        return view($this->component, [
            'form' => $this->form
        ]);
    }

    public function updated($field)
    {
        session()->put('form-fields', $this->fields);
        $this->setValidation();

        $this->validateOnly($field, $this->parseNamespaceRules($this->validation));
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

        // Check for dot notations
        foreach ($this->fields as $key => $value) {
            Arr::set($this->fields, $key, $value);
        }

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

    public function flash($name, $message)
    {
        $this->flashes[$name] = $message;
    }

    protected function checkFiles()
    {
        if (TemporaryUploadedFile::canUnserialize($this->files)) {
            $this->files = TemporaryUploadedFile::unserializeFromLivewireRequest($this->files);
        }
    }

    protected function parseNamespaceRules($rules = [])
    {
        foreach ($rules as $fieldKey => $fieldRules) {
            if (is_object($fieldRules)) continue;

            if (! is_array($fieldRules)) {
                if (class_exists($fieldRules)) {
                    $rules[$fieldKey] = app($fieldRules);
                }
                continue;
            }

            foreach ($fieldRules as $ruleKey => $rule) {
                if (is_object($rule)) continue;

                if (class_exists($rule)) {
                    $rules[$fieldKey][$ruleKey] = app($rule);
                }
            }
        }

        return $rules;
    }
}
