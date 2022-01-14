<?php

namespace Tests;

use Codedor\LivewireForms\Fields\Button;
use Codedor\LivewireForms\Fields\MultiFileField;
use Codedor\LivewireForms\Fields\Step;
use Codedor\LivewireForms\Fields\TextField;
use Codedor\LivewireForms\Form;

class TestWithFileStepForm extends Form
{
    public function fields()
    {
        return [
            Step::make('step 1')
                ->step(1)
                ->fields(
                    [
                        TextField::make('name')
                            ->rules('required'),
                        Button::make('Next step')->action('nextStep'),
                    ]
                ),

            Step::make('step 2')
                ->step(2)
                ->fields([
                    MultiFileField::make('image')
                        ->rules('required')
                        ->format('thumb')
                        ->disk('public'),
                    Button::make('Previous step')->action('previousStep'),
                    Button::make('Submit'),
                ])
        ];
    }
}