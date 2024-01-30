<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    @include('livewire-forms::fields.label')

    <textarea
        @include('livewire-forms::fields.binding')
        id="{{ $field->getName() }}"
        @class([
            $field->class ?? config('livewire-forms.defaults.inputClass'),
            'is-invalid' => $errors->first(($field->containsFile ? 'files.' : 'fields.') . $field->getName()),
        ])
        name="{{ $field->getName() }}"
        placeholder="{{ $field->getLabel() }}"
        rows="{{ $field->rows ?? config('livewire-forms.defaults.textareaRows') }}"
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    ></textarea>

    @include('livewire-forms::fields.gdpr')

    @include('livewire-forms::fields.error')
</div>
