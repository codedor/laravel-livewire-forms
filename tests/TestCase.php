<?php

namespace Tests;

use Codedor\LivewireForms\LivewireFormsServiceProvider;
use Codedor\Media\Providers\MacroServiceProvider;
use Livewire\LivewireServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'base64:Inq+Xktf8hUV2iyfvKnYOrOFU7CQ7IuOHI2n7AnxisI=');

        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('media.types.image', ['image/jpeg']);
        $app['config']->set('media.formats', [
            'thumb' => 'Codedor\Media\Filters\ThumbFilter',
            'low_res' => 'Codedor\Media\Filters\LowResFilter',
        ]);

        $app['config']->set('translatable.locales', ['en']);
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            LivewireFormsServiceProvider::class,
            MacroServiceProvider::class,
        ];
    }

    /**
     * Define database migrations.
     *
     * @return void
     */
    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../vendor/codedor/laravel-media/database/migrations');

        $this->artisan('migrate')->run();

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:fresh')->run();
        });
    }
}
