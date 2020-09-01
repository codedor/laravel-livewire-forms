<div>
    <input
        @include('livewire-forms::fields.binding')
        id="{{ $field->getName() }}"
        type="hidden"
        name="{{ $field->getName() }}"
        value="{{ $field->getValue() }}"
    >
</div>
