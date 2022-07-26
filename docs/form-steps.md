# Form steps

Sometimes your form has multiple steps.

You can define these steps in your Form file, for example:

```php
class AnnouncementForm extends Form
{
    public static function fields(): array
    {
        return [
            Step::make(__('announcement.info step title'))
                ->step(1)
                ->fields(
                    [
                        TextField::make('company'),
                        TextField::make('vat'),
                        Button::make('Next step')->action('nextStep'),
                    ]
                ),

            Step::make(__('announcement.billing step title'))
                ->step(2)
                ->fields(
                    [
                        TextField::make('company'),
                        TextField::make('vat'),
                        Button::make('Previous step')->action('previousStep'),
                        Button::make('Submit'),
                    ]
                )
        ];
    }
}
```

Each step has three arguments:

1. The step number
2. The step name, to be shown in the frontend
3. The fields that the step holds

For readabilities sake, I would suggest to make each step a separate file, so you can load the fields like this:

```php
public static function fields(): array
{
    return [
        Step::make(__('announcement.info step title'))
            ->step(1)
            ->fields(AnnouncementInfoForm::fields()),

        Step::make(__('announcement.billing step title'))
            ->step(2)
            ->fields(AnnouncementBillingForm::fields())
    ];
}
```

## Moving from step to step

Notice the buttons, they are calling pre-defined actions on the form controller:

1. `nextStep`: Moves the step up one
2. `previousStep`: Moves the step down one

There is also `goToStep($step)`, but as of right now, you cannot use this on buttons.
You can however use it in the blade files.
