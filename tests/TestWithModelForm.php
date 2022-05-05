<?php

namespace Tests;

use Codedor\LivewireForms\Fields\TextField;
use Codedor\LivewireForms\Form;

class TestWithModelForm extends Form
{
    public $modelClass = TestModel::class;

    public function fields()
    {
        return [
            TextField::make('name')
                ->rules('required'),
        ];
    }
}
