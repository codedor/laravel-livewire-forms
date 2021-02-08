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
    >

    @includeWhen(
        $field->tooltip,
        'livewire-forms::components.tooltip',
        ['text' => $field->tooltip]
    )

    @include('livewire-forms::fields.error')
</div>
