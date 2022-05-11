<?php

namespace Tests;

use Codedor\LivewireForms\FormController;
use Codedor\Media\Models\Attachment;

class TestFormController extends FormController
{
    public $modelClass = Attachment::class;
}