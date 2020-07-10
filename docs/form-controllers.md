## Form controllers
This page will go over the different functions a form controller has.

* [submit()](#submit)
    * [beforeSubmit()](#before-submit)
    * [validateData()](#validate-data)
    * [parseConditionalData()](#parse-conditional-data)
    * [saveUploadedFiles()](#save-uploaded-files)
    * [saveData()](#save-data)
    * [successMessage()](#success-message)
    * [afterSubmit()](#after-submit)
    * [resetForm()](#reset-form)
* [Dangerous functions](#dangerous-functions)
    * [updated()](#updated)
    * [render()](#render)
    * [nextStep()](#next-step)
    * [previousStep()](#previous-step)
    * [goToStep()](#go-to-step)
    * [validateStep()](#validate-step)

### <a name="submit"></a>Submit
The following functions are all called when you press the `submit` button on your field, in that order.

#### <a name="before-submit"></a>beforeSubmit()
By default this is empty.

#### <a name="validate-data"></a>validateData()
This validates your data.
This is done by Livewire itself.

#### <a name="parse-conditional-data"></a>parseConditionalData()
This will remove any fields that are filtered out by `conditional`s.

This function is considered a [dangerous function](#dangerous-functions)!

#### <a name="save-uploaded-files"></a>saveUploadedFiles()
Because files are tricky to save, it is done separately.

This function is considered a [dangerous function](#dangerous-functions)!

#### <a name="save-data"></a>saveData()
This will save your data into the model you defined, if no `$this->model` exists, nothing will happen.

You'll want to extend this function when dealing with multiple models to save.

#### <a name="success-message"></a>successMessage()
Returns a message to the session to be shown, overwrite this to show a different message:
```php
public function successMessage()
{
    session()->flash('message', __('form.custom success message'));
}
```

#### <a name="after-submit"></a>afterSubmit()
By default this is empty.

#### <a name="reset-form"></a>resetForm()
This resets your entire form and clears all data.

### <a name="dangerous-functions"></a>Dangerous functions
**WARNING**: Beware editing these, as they were not meant to be changed.

#### <a name="render"></a>render()
This is a function of Livewire itself, here we set the session that holds your current step value and fields.

#### <a name="next-step"></a>nextStep()
#### <a name="previous-step"></a>previousStep()
#### <a name="go-to-step"></a>goToStep()
These functions move the current step to a new value.

#### <a name="validate-step"></a>validateStep()
This validates the fields of the current step.
