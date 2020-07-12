<?php

namespace Codedor\LivewireForms\Traits;

trait HasSteps
{
    public $step = 1;

    public function nextStep()
    {
        $this->validateStep();
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function goToStep($index)
    {
        if ($index <= $this->step) {
            $this->step = $index;
        }
    }

    public function validateStep($step = null)
    {
        $validation = $this->form::stepValidation($step ?? $this->step);
        $this->validate($validation);
    }

}
