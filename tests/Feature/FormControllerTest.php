<?php

use Codedor\LivewireForms\FormController;
use Livewire\TemporaryUploadedFile;
use function Pest\Livewire\livewire;
use Tests\TestForm;
use Tests\TestModel;
use Tests\TestStepForm;
use Tests\TestWithComplexValidationForm;
use Tests\TestWithFileForm;
use Tests\TestWithFileStepForm;
use Tests\TestWithFlashForm;
use Tests\TestWithModelForm;

test('form controller throws exception if formClass is not passed', function () {
    $this->expectException(Exception::class);
    livewire(FormController::class);
    $this->assertException('Did not pass a $formClass in the FormController or blade file.');
});

test('form controller will render', function () {
    livewire(FormController::class, [
        'formClass' => TestForm::class,
    ])
        ->assertSeeHtml('<div id="livewire-form">');
});

test('form controller sets default locale', function () {
    app()->setLocale('en');
    livewire(FormController::class, [
        'formClass' => TestForm::class,
    ])
        ->assertSet('locale', 'en');
});

test('form controller will validate', function () {
    livewire(FormController::class, [
        'formClass' => TestWithComplexValidationForm::class,
    ])
        ->set('fields.validation_object', '')
        ->assertHasErrors('fields.validation_object')
        ->set('fields.validation_object', 'test')
        ->assertHasNoErrors('fields.validation_object')
        ->set('fields.validation_uppercase', 'blaat')
        ->assertHasErrors('fields.validation_uppercase')
        ->set('fields.validation_uppercase', 'BLAAT')
        ->assertHasNoErrors('fields.validation_uppercase')
        ->set('fields.validation_array', '')
        ->assertHasErrors('fields.validation_array');
});

test('form controller will set fields', function () {
    livewire(FormController::class, [
        'formClass' => TestForm::class,
    ])
        ->set('fields.name', 'field name')
        ->assertSet('fields.name', 'field name')
        ->set('fields.name', 'test');
});

test('form controller will upload files', function () {
    livewire(FormController::class, [
        'formClass' => TestWithFileForm::class,
    ])
        ->set('files.image', TemporaryUploadedFile::fake()->image('image.jpg'))
        ->assertHasNoErrors('files.image')
        ->call('submit')
        ->assertSee('form.success message');

    $this->assertDatabaseHas('attachments', [
        'filename_without_extension' => 'image',
        'extension' => 'jpg',
    ]);
});

test('form controller will flash', function () {
    livewire(FormController::class, [
        'formClass' => TestWithFlashForm::class,
    ])
        ->call('flash', 'auth-component', 'Wrong password!')
        ->assertSet('flashes.auth-component', 'Wrong password!');
});

test('form controller can upload multiple files in a form with steps', function () {
    livewire(FormController::class, [
        'formClass' => TestWithFileStepForm::class,
    ])
        ->set('fields.name', 'field name')
        ->call('nextStep')
        ->set('files.image', [
            TemporaryUploadedFile::fake()->image('image.jpg'),
            TemporaryUploadedFile::fake()->create('document.pdf', 1024, 'application/pdf'),
        ])
        ->assertHasNoErrors('files.image')
        ->call('submit')
        ->assertSee('form.success message');

    $this->assertDatabaseCount('attachments', 2);
    $this->assertDatabaseHas('attachments', [
        'filename_without_extension' => 'image',
        'extension' => 'jpg',
    ]);

    $this->assertDatabaseHas('attachments', [
        'filename_without_extension' => 'document',
        'extension' => 'pdf',
    ]);
});

test('form controller can upload multiple files in a form for a specific step', function () {
    livewire(FormController::class, [
        'formClass' => TestWithFileStepForm::class,
    ])
        ->set('fields.name', 'field name')
        ->call('nextStep')
        ->set('files.image', [
            TemporaryUploadedFile::fake()->image('image.jpg'),
            TemporaryUploadedFile::fake()->create('document.pdf', 1024, 'application/pdf'),
        ])
        ->assertHasNoErrors('files.image')
        ->call('saveUploadedFiles', 2);

    $this->assertDatabaseCount('attachments', 2);
    $this->assertDatabaseHas('attachments', [
        'filename_without_extension' => 'image',
        'extension' => 'jpg',
    ]);

    $this->assertDatabaseHas('attachments', [
        'filename_without_extension' => 'document',
        'extension' => 'pdf',
    ]);
});

test('form controller can go to next and previous step', function () {
    livewire(FormController::class, [
        'formClass' => TestStepForm::class,
    ])
        ->assertSet('step', 1)
        ->set('fields.name', 'field name')
        ->call('nextStep')
        ->assertSet('step', 2)
        ->call('previousStep')
        ->assertSet('step', 1)
        ->set('fields.name', '')
        ->call('nextStep')
        ->assertHasErrors(['fields.name'])
        ->set('fields.name', 'field name')
        ->call('nextStep')
        ->assertSet('step', 2)
        ->call('goToStep', 1)
        ->assertSet('step', 1);
});

test('form controller will create model', function () {
    $testModel = $this->createMock(TestModel::class);
    $testModel->expects()->method('create')->once();

    livewire(FormController::class, [
        'formClass' => TestWithModelForm::class,
    ])
        ->set('fields.name', 'field name')
        ->call('submit')
        ->assertSee('form.success message');
});
