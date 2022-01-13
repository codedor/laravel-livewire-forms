<?php

namespace Tests;

use Codedor\LivewireForms\Fields\Button;
use Codedor\LivewireForms\Fields\Step;
use Codedor\LivewireForms\Fields\TextField;
use Codedor\LivewireForms\Form;

class TestStepForm extends Form
{
    public function fields()
    {
        return [
            Step::make('step 1')
                ->step(1)
                ->fields(
                    [
                        TextField::make('name'),
                        Button::make('Next step')->action('nextStep'),
                    ]
                ),

            Step::make('step 2')
                ->step(2)
                ->fields([
                    TextField::make('company'),
                    Button::make('Previous step')->action('previousStep'),
                    Button::make('Submit'),
                ])
        ];
    }
}