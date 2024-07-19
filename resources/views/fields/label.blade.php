<label
    for="{{ $field->getName() }}"
    @class([
        $field->labelClass ?? config('livewire-forms.defaults.labelClass'),
        $field->getValue() ? 'changed' : ''
    ])
>
    {{ $field->getLabel() }}
</label>
