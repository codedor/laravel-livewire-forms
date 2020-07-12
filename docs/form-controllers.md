## Form controllers

This page will go over every function the Form Controller has.

You can extend any of these when building your controller, however some of them are quite dangerous to extend, as they take care of important things you may not want to get rid of. So think twice before extending any of the functions that have a ⚠️ icon next to them.

Functions with a 🦑 next to them are existing Livewire functions.

* [afterSubmit()](#after-submit)
* [beforeSubmit()](#before-submit)
* ⚠️ [goToStep()](#go-to-step)
* ⚠️🦑 [hydrate()](#hydrate)
* ⚠️🦑 [mount()](#mount)
* ⚠️ [nextStep()](#next-step)
* ⚠️ [previousStep()](#previous-step)
* ⚠️🦑 [render()](#render)
* [resetForm()](#reset-form)
* [saveData()](#save-data)
* ⚠️ [saveUploadedFiles()](#save-uploaded-files)
* ⚠️ [setFields()](#set-fields)
* ⚠️ [setValidation()](#set-validation)
* ⚠️ [submit()](#submit)
* [successMessage()](#success-message)
* [validateData()](#validate-data)
* ⚠️ [validateStep()](#validate-step)

---

### <a name="after-submit"></a> afterSubmit()
Right after saving all the data, `afterSubmit()` is called, by default this is empty.

---

### <a name="before-submit"></a> beforeSubmit()
Just before saving all the data, `beforeSubmit()` is called, by default this is empty.

---

### <a name="go-to-step"></a> ⚠️ goToStep($step)
This will move the current step to the given index.

This is used in the steps component blade file, to make links to previous steps in the form.

---

### <a name="hydrate"></a> ⚠️🦑 hydrate()
This will set the app locale to the given locale, this is for data that is fetched from the DB, since Livewire calls don't pass the locale.

---

### <a name="mount"></a> ⚠️🦑 mount()
The mount function will set everything up, and remove any old data that was still in session.

```php
public function mount($component = null, $form = null)
{
    $this->form = $this->form ?? $form;
    $this->locale = $this->locale ?? app()->getLocale();
    $this->component = $component ?? 'livewire-forms::form-steps';
    $this->setValidation();

    session()->remove('step');
    session()->remove('form-fields');
}
```

---

### <a name="next-step"></a> ⚠️ nextStep()
Moves the current step up, by one.

---

### <a name="previous-step"></a> ⚠️ previousStep()
Moves the current step down, by one.

---

### <a name="render"></a> ⚠️🦑 render()
Every time the render function is called, the fields are re-loaded, and conditional checks are done again.

```php
public function render()
{
    $this->setFields();
    $this->setValidation();

    session()->put('step', $this->step);
    session()->put('form-fields', $this->fields);

    return view($this->component);
}
```

---

### <a name="reset-form"></a> resetForm()
Clears all the data in the form.
This is done at the end of the submit flow.

---

### <a name="save-data"></a> saveData()
Saves the entered data to the model, if there is one defined, and saves it into `$this->savedModel`, for use in later functions if neede.

```php
public function saveData()
{
    if ($this->model) {
        $this->savedModel = $this->model::create($this->fields);
    }
}
```

---

### <a name="save-uploaded-files"></a> ⚠️ saveUploadedFiles()
This will go through all the uploaded files and save them to the Attachment model.

---

### <a name="set-fields"></a> ⚠️ setFields()
Re-loads the fields, while doing conditional checks.

---

### <a name="set-validation"></a> ⚠️ setValidation()
Re-loads the validation rules, while doing conditional checks.

---

### <a name="submit"></a> ⚠️ submit()
Will start the submit flow, this is called by the button field, if no action is given.

```php
public function submit()
{
    $this->beforeSubmit(); // Parse special fields
    $this->validateData(); // Validate
    $this->saveUploadedFiles(); // Save uploaded files (HandleFiles trait)
    $this->saveData(); // Save the model
    $this->successMessage(); // Success message
    $this->afterSubmit(); // Do other things, like mails
    $this->resetForm(); // Reset form
}
```

---

### <a name="success-message"></a> successMessage()
Displays a success message by flashing the session.
```php
public function successMessage()
{
    session()->flash('message', __('form.success message'));
}
```

---

### <a name="validate-data"></a> ⚠️ validateData()
Validates every field in the form (including all steps).

---

### <a name="validate-step"></a> ⚠️ validateStep($step)
Validates every field in the given step.
