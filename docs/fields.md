## Fields
This package has a bunch of fields that come with it, here you can find a list of everything (in alphabetical order), with examples.

---
* [General notes and information](#important-notes)
    * [Adding a field](#adding-field)
    * [Conditional fields](#conditional-fields)
    * [Custom component](#custom-component)
    * [Validation](#validation)
* [Button](#button)
* [Checkbox](#checkbox)
* [Country](#country)
* [Currency](#currency)
* [Date](#date)
* [Email](#email)
* [File](#file)
* [Group](#group)
* [Hidden](#hidden)
* [Row](#row)
* [RadioGroup](#radio-group)
* [Password](#password)
* [Select](#select)
* [Step](#step)
* [Textarea](#textarea)
* [Text](#text)
* [Title](#title)

---
### <a name="important-notes"></a>General notes and information

#### <a name="adding-field"></a>Adding a field
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
#### <a name="conditional-fields"></a>Conditional fields
If some fields may only be shown when another field is a certain value, you can add `->conditional` to your field. There's a couple of different ways to do this. First, you can just add this, then it will check if the field name you entered is `true`, this is handy for checking on checkbox fields.

```php
CheckboxField::make('show_contact_fields'),

Field::make('contact_first_name')
    ->conditional('show_contact_fields')
```

If you want to check on a specific value, you can add the second parameter
```php
CheckboxField::make('show_contact_fields'),

Field::make('contact_first_name')
    ->conditional('show_contact_fields', false)
```

If you want full control, add a closure as the second parameter, you have access to a couple of variables in this closure, as seen here:
```php
CheckboxField::make('show_contact_fields'),

Field::make('contact_first_name')
    ->conditional('show_contact_fields', (function($value, $key, $fields) {
        /**
         * $value  // The value of the field you are checking on
         * $key    // The key name of the field (show_contact_fields in this example)
         * $fields // All the other fields in the form
         */
        return ($value === 'Superman' && $fields['first_name'] === 'Clark')
    })
```

#### <a name="custom-component"></a>Custom component
If you want full control of your blade file, you can either make a [Custom Field](custom-fields.md) or call a different blade file like so:
```php
Field::make('field_name')
    ->component('components.fields.custom_field')
```

#### <a name="validation"></a>Validation
You can also pass along rules, just like you would anywhere else in Laravel:
```php
Field::make('field_name')
    ->rules('required_if:fields.contact_info,true')
```
```

#### Default values
You can define a default value for your field by adding the `value` or `default` function.
```php
Field::make('field_name')
    ->value('Clark Kent')
```

#### Specific blade variables
Should you, for whatever reason, require a specific variable for a field, you can pass along anything you like. This can be useful for Frontend, should they require certain class names for a field.
```php
Field::make('field_name')
    ->superman('Clark Kent')
```
You can then call this data in the blade file:
```php
{{ $field->superman }}
```

---
### <a name="button"></a>Button

The `Button` field is usually used to make the submit form button.
```php
Button::make(__('form.submit'))
```
The first argument is used for the label.

If you want the button to do another action defined in your FormController, add the `action` function to the Button field.

```php
Button::make(__('form.next step'))
    ->action('doSomethingElse')
```

---
### <a name="country"></a>Country

The checkbox fields creates a dropdown with countries.
```php
CountryField::make('country')
```
**Note:** this uses the select field blade file, pass `->component()` with a custom blade file if needed.

---
### <a name="currency"></a>Currency

The currency field will put a symbol in front (or back) of the text put in.
```php
CurrencyField::make('price')
    ->symbol('€')
```

Or you can define something to come after the text.
```php
CurrencyField::make('price')
    ->symbolAfter('$')
```
**Note:** this uses the text field blade file, pass `->component()` with a custom blade file if needed.

---
### <a name="checkbox"></a>Checkbox

The checkbox fields creates a single checkbox on your form.
```php
CheckboxField::make('contact_me')
    ->label(__('announcement.contact me label')),
```

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
### <a name="group"></a>Group
A group passes all variables it has to its fields, for example, if you need to make a bunch of fields conditional, and they need to have a certain prefix, you can create a Group like this:
```php
Group::make()
    ->prefix('contact')
    ->conditional('contact_info')
    ->rules('required')
    ->fields([
            TextField::make('first_name'),
            TextField::make('last_name'),
            TextField::make('email'),
            TextField::make('phone'),
    ]),
```

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
You can also use a closure for the options, where you can gather data from other fields.
```php
SelectField::make('field_name')
    ->options(function ($fields) {
        $options = [
            'batman' => 'Bruce Wayne',
            'flash' => 'Barry West',
        ];
        
        if ($fields['other_field'] === 'Superman') {
            $options['superman'] = 'Clark Kent';
        }
        
        return $options;
    })
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
