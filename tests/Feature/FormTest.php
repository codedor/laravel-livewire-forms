<?php

use Codedor\LivewireForms\Fields\CheckboxField;
use Codedor\LivewireForms\Fields\Flash;
use Codedor\LivewireForms\Fields\TextField;
use Tests\TestForm;
use Tests\TestStepForm;
use Tests\TestWithConditionalFieldForm;
use Tests\TestWithFileForm;
use Tests\TestWithFlashForm;

test('form sets form-binding session', function () {
    new TestForm();

    $this->assertEquals('livewire', session('form-binding'));
});

test('form returns field stack', function () {
    $form = new TestForm();

    $this->assertEquals(
        $form->fields(),
        $form->fieldStack()
    );
});

test('form returns field stack with conditional fields', function () {
    $form = new TestWithConditionalFieldForm();
    session()->put('form-fields.show_name', false);

    $this->assertEquals(
        [
            CheckboxField::make('show_name')
        ],
        $form->fieldStack(true)
    );

    session()->put('form-fields.show_name', true);
    $this->assertEquals(
        $form->fields(),
        $form->fieldStack(true)
    );
});

test('form field stack skips non-fields', function () {
    $form = new TestWithFlashForm();

    $this->assertEquals(
        [],
        $form->fieldStack(true)
    );
});

test('form return field stack from field', function () {
    $form = new TestStepForm();

    $this->assertCount(
        1,
        $form->getFieldStackFromField($form->fields()[0])
    );
});

test('form return empty field stack from non-step field', function () {
    $form = new TestWithFlashForm();

    $this->assertEmpty(
        $form->getFieldStackFromField(Flash::make('auth-errors'))
    );
});

test('form sets validation for fields', function () {
    $form = new TestForm();

    $this->assertEquals(
        [
            'fields.name' => 'required',
        ],
        $form->validation()
    );
});

test('form sets validation for files', function () {
    $form = new TestWithFileForm();

    $this->assertEquals(
        [
            'files.image' => 'required',
        ],
        $form->validation()
    );
});

test('form skips conditional validation', function () {

});

test('form sets validation for steps', function () {
    $form = new TestForm();

    $this->assertEquals(
        [
            'fields.name' => 'required',
        ],
        $form->validation()
    );
});

test('form returns fields for specific step', function () {

});

test('form returns validation for specific step', function () {

});

test('form returns file fields', function () {

});

test('form returns field stack for files for specific step', function () {

});