<?php

namespace Codedor\LivewireForms;

use Illuminate\Support\ServiceProvider;

class LivewireFormsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViews();
        $this->publishData();
    }

    public function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'livewire-forms');
    }

    public function publishData()
    {
        $this->publishes(
            [__DIR__ . '/../resources/views' => resource_path('views/vendor/livewire-forms')],
            'livewire-forms'
        );
    }
}
