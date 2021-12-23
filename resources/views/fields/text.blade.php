<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    @include('livewire-forms::fields.label')

    <input
        @include('livewire-forms::fields.binding')
        id="{{ $field->getName() }}"
        type="{{ $field->type ?? 'text' }}"
        class="{{ $field->class ?? config('livewire-forms.defaults.inputClass') }}"
        name="{{ $field->getName() }}"
        placeholder="{{ $field->getLabel() }}"
        value="{{ $field->getValue() }}"
        @if($field->readOnly) disabled @endif
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    >

    @include('livewire-forms::fields.gdpr')

    @include('livewire-forms::fields.error')
</div>
