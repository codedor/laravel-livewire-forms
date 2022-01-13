<?php

namespace Tests;

use Codedor\LivewireForms\Fields\Flash;
use Codedor\LivewireForms\Fields\TextField;
use Codedor\LivewireForms\Form;
use Illuminate\Validation\Rules\RequiredIf;

class TestWithComplexValidationForm extends Form
{
    public function fields()
    {
        return [
            TextField::make('validation_object')
                ->rules(new RequiredIf(true)),
            TextField::make('validation_uppercase')
                ->rules(UppercaseRule::class),
            TextField::make('validation_array')
                ->rules([
                    new RequiredIf(true),
                    UppercaseRule::class
                ]),
        ];
    }
}