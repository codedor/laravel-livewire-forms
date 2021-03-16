# Livewire Laravel Forms

## Installation
Install by running
```
composer require codedor/laravel-livewire-forms
```

You can publish all the blade field files by running
```
php artisan vendor:publish --tag="livewire-forms"
```

If you have not used Livewire in your project before, remember to add the following blade directives:

```html
    ...
    @livewireStyles
</head>
<body>
    ...

    @livewireScripts
</body>
</html>
```


## Documentation
* [Creating forms (start here)](./docs/creating-forms.md)
* [Fields](./docs/fields.md)
* [Custom fields](./docs/custom-fields.md)
* [Form controller](./docs/form-controllers.md)
* [Form steps](./docs/form-steps.md)
* [Examples](./docs/examples.md)
