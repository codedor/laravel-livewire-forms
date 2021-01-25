## Form controllers

This page will go over every function the Form Controller has.

You can extend any of these when building your controller, however some of them are quite dangerous to extend, as they take care of important things you may not want to get rid of. So think twice before extending any of the functions that have a ⚠️ icon next to them.

Functions with a 🦑 next to them are existing Livewire functions.

* [afterSubmit()](#after-submit)
* [beforeSave()](#before-save)
* [beforeSubmit()](#before-submit)
* ⚠️ [checkFiles()](#check-files)
* ⚠️ [goToStep()](#go-to-step)
* ⚠️🦑 [hydrate()](#hydrate)
* ⚠️🦑 [mount()](#mount)
* ⚠️ [nextStep()](#next-step)
* ⚠️ [previousStep()](#previous-step)
* ⚠️🦑 [render()](#render)
* [resetForm()](#reset-form)
* [saveData()](#save-data)
* [syncData()](#sync-data)
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

### <a name="before-save"></a> beforeSave()
Just before saving all the data, `beforeSave()` is called, by default this is empty.

---

### <a name="before-submit"></a> beforeSubmit()
At the start of the saving logic, `beforeSubmit()` is called, by default this is empty.

---

### <a name="check-files"></a> checkFiles()
This function catches a bug from Livewire, where if you have a multi-file field and trigger a validation error, the files would be lost.

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
    session()->put('form-fields', $this->fields);
    session()->put('step', $this->step);

    $this->form = $this->getForm();
    $this->fieldStack = $this->form->fieldStack(false);

    $this->setFields();
    $this->setValidation();

    $this->checkFiles();

    View::share('files_', $this->files);
    View::share('fields_', $this->fields);

    return view($this->component, [
        'form' => $this->form
    ]);
}
```

---

### <a name="reset-form"></a> resetForm()
Clears all the data in the form.
This is done at the end of the submit flow.

---

### <a name="save-data"></a> saveData()
Saves the entered data to the model, if there is one defined, and saves it into `$this->savedModel`, for use in later functions if needed.

```php
public function saveData()
{
    if ($this->model) {
        $this->savedModel = $this->model::create($this->fields);
    }
}
```

### <a name="sync-data"></a> syncData()
When using fields like the [MultiFileField](fields.md#multi-file-field), you'll need to add your relation names to the `$sync` attribute of your form, otherwise your pivot data will not save.

```php
public function syncData()
{
    if ($this->savedModel && !empty($this->syncs)) {
        foreach ($this->syncs as $relation) {
            $this->savedModel->{$relation}()->sync($this->fields[$relation]);
        }
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
    $this->beforeSave(); // Do something just before saving
    $this->saveData(); // Save the model
    $this->syncData(); // Syncs any relation pivot data
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
