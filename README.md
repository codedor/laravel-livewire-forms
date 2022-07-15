# Laravel Livewire Forms

Package to easily configure Livewire forms with a set of existing fields.

## Installation

You can install the package via composer:

```bash
composer require codedor/laravel-livewire-forms
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="livewire-forms-config"
```

This is the contents of the published config file:

```php
return [
    'defaults' => [
        'inputClass' => '',
        'divClass' => 'col-6',
    ]
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="livewire-forms-views"
```

## Usage

```blade
@livewire('registration-form')
```

## Documentation

For the full documentation, check [here](./docs/index.md).

## Testing

```bash
vendor/bin/pest
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Upgrading

Please see [UPGRADING](UPGRADING.md) for more information on how to upgrade to a new version.