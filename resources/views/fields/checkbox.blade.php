<div class="{{ $field->divClass ?? 'col-6' }} form-group required">
    <input
        type="checkbox"
        class="{{ $field->class }}"
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}"
        wire:model.lazy="fields.{{ $field->getName() }}"
    >

    @include('livewire-forms::fields.label')

    @include('livewire-forms::fields.error')
</div>
