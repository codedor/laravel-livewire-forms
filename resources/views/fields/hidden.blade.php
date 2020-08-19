<div>
    <input
        @include('livewire-forms::fields.binding')
        id="{{ $field->getUniqueIdName() }}"
        type="hidden"
        name="{{ $field->getName() }}"
        value="{{ $field->getValue() }}"
    >
</div>
