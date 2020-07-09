

## Fields
This package has a bunch of fields that come with it, here you can find a list of everything (in alphabetical order), with examples.

---
### Important notes
This information goes for almost every fields in the list, however should something differ, it will be noted.
To initialize a field, use the `::make`, like you would in Nova:
```php
Field::make('field_name')
```
A label and tooltip can be passed along like this:
```php
Field::make('field_name')
    ->label(__('form.field label'))
    ->tooltip(__('form.field tooltip'))
```
You can also pass along rules, just like you would anywhere else in Laravel:
```php
Field::make('field_name')
    ->rules('required_if:fields.contact_info,true')
```
Should you, for whatever reason, require a specific variable for a field, you can pass along anything you like. This can be useful for Frontend, should they require certain class names for a field.
```php
Field::make('field_name')
    ->superman('Clark Kent')
```
You can then call this data in the blade file:
```php
{{ $field->superman }}
```
If you want full control of your blade file, you can either make a [Custom Field](custom-fields.md) or call a different blade file like so:
```php
Field::make('field_name')
    ->component('components.fields.custom_field')
```
You can define a default value for your field by adding the `value` or `default` function.
```php
Field::make('field_name')
    ->value('Clark Kent')
```

---

1. [Button](#button)
2. [Checkbox](#checkbox)
3. [Conditional](#conditional)
4. [Country](#country)
5. [Date](#date)
6. [Email](#email)
7. [File](#file)
8. [Hidden](#hidden)
9. [Row](#row)
10. [RadioGroup](#radio-group)
11. [Password](#password)
12. [Select](#select)
13. [Step](#step)
14. [Textarea](#textarea)
15. [Text](#text)
16. [Title](#title)
---
### <a name="button"></a>Button

The `Button` field is usually used to make the submit form button.
```php
Button::make(__('form.submit'))
```
The first argument is used for the label.
If you want the button to do another action defined in your FormController, add the `action` function to the Button field, like so:

```php
Button::make(__('form.next step'))
    ->action('nextStep')
```

---
### <a name="country"></a>Country

The checkbox fields creates a dropdown with countries.
```php
CountryField::make('country')
```
**Note:** this uses the select field blade file, pass `->component()` with a custom blade file if needed.

---
### <a name="checkbox"></a>Checkbox

The checkbox fields creates a single checkbox on your form.
```php
CheckboxField::make('contact_me')
    ->label(__('announcement.contact me label')),
```

---
### <a name="conditional"></a>Conditional
The conditional field is used to show certain fields when needed.
For example, in a billing form, you could have a checkbox that says "Use a different billing address".
This can be achieved by using the conditional field.
```php
CheckboxField::make('billing_address'),

Conditional::make(
    'billing_address',
    true,
    [
        TextField::make('contact_email')
            ->rules('required')
    ]
]),
```
The first argument is the field name that the conditional field is going to check, the second parameter is the value it will check for. In this example, it will check if `'billing_address'` equals `true` (aka checked). If so, the fields in the third parameter will be shown.

If you **also** need to show fields when `'billing_address'` equals `false`, you can pass an array of fields as the fourth parameter, just like the third parameter. These will be shown if the check does not pass.

---
### <a name="date"></a>Date
The date field returns a basic HTML5 datepicker.
```php
DateField::make('end_date')
    ->rules('required|date|after:fields.start_date')
```

---
### <a name="email"></a>Email
The email field returns a basic email input field.
```php
EmailField::make('email')
```
**Note:** this uses text field blade file, pass `->component()` with a custom blade file if needed.

---
### <a name="file"></a>File
The file field returns a basic file input field.
```php
FileField::make('file_id')
```
You can define a certain disk to save to like so:
```php
FileField::make('file_id')
    ->disk('private')
```
**Note:** it is important that you make the fieldname an `_id`, as this package returns an Attachment ID when saving the file.

---
### <a name="hidden"></a>Hidden
The hidden field returns a hidden input, this is useful if for example you need the `user_id` saved in your model.
```php
HiddenField::make('user_id')
    ->value(optional(auth('user')->user())->id),
```

---
### <a name="radio-group"></a>RadioGroup
Returns a group of radio buttons, pass the different options in the `options` function.
```php
RadioGroup::make('registration_student_type')
    ->options([
        'first' => 'Number one',
        'second' => 'Number two',
        'three' => 'Number three'
    ])
```

---
### <a name="row"></a>Row
For Frontend purposes, use this "field" to split up multiple fields.
```php
Row::make([
    TextField::make('first_field'),
    TextField::make('second_field'),
]),
Row::make([
    TextField::make('third_field'),
]),
```
This will return two rows, one with two fields and one with only one field.

---
### <a name="password"></a>Password
The password field returns a basic password input field.
```php
PasswordField::make('email')
```
**Note:** this uses text field blade file, pass `->component()` with a custom blade file if needed.

---
### <a name="select"></a>Select
Returns a basic HTML5 select field, you have to pass an array to the `options` function like so:
```php
SelectField::make('field_name')
    ->options([
        'first' => 'Number one',
        'second' => 'Number two',
        'three' => 'Number three'
    ])
```

---
### <a name="step"></a>Step
You can split your form in multiple steps by using the Step feature.
Read more about it [here](form-steps.md).

---
### <a name="textarea"></a>Textarea
The text field returns a basic textarea input field.
```php
TextareaField::make('field_name')
```

---
### <a name="text"></a>Text
The text field returns a basic text input field.
```php
TextField::make('field_name')
```

---
### <a name="title"></a>Title
The title "field" creates a subtitle in the form.
```php
Title::make('This is a title!')
```
