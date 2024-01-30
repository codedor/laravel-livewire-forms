<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    @include('livewire-forms::fields.label')

    <input
        @include('livewire-forms::fields.binding')
        id="{{ $field->getName() }}"
        type="date"
        @class([
            $field->class ?? config('livewire-forms.defaults.inputClass'),
            'is-invalid' => $errors->first(($field->containsFile ? 'files.' : 'fields.') . $field->getName()),
        ])
        class="{{ $field->class }}"
        name="{{ $field->getName() }}"
        @if($field->readOnly) disabled @endif
        value="{{ $field->getValue() }}"
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    >

    @include('livewire-forms::fields.gdpr')

    @include('livewire-forms::fields.error')
</div>
