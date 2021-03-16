<div class="{{ $field->divClass ?? 'col-6' }}">
    @include('livewire-forms::fields.label')

    <input
        @include('livewire-forms::fields.binding')
        id="{{ $field->getName() }}"
        type="date"
        class="{{ $field->class }}"
        name="{{ $field->getName() }}"
        placeholder="{{ $field->getLabel() }}"
        @if($field->readOnly) disabled @endif
        value="{{ $field->getValue() }}"
    >

    @include('livewire-forms::fields.gdpr')

    @include('livewire-forms::fields.error')
</div>
