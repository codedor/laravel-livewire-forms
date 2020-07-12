<div class="{{ $field->divClass ?? 'col-6' }}">
    @include('livewire-forms::fields.label')

    <input
        type="date"
        class="{{ $field->class }}"
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}"
        placeholder="{{ $field->getLabel() }}"
        wire:model.lazy="fields.{{ $field->getName() }}"
    >

    @include('livewire-forms::fields.error')
</div>
