<div class="{{ $field->divClass ?? 'col-6' }} form-group required">
    <input
        type="checkbox"
        class="{{ $field->class }}"
        id="{{ $field->name }}"
        name="{{ $field->name }}"
        wire:model.lazy="fields.{{ $field->name }}"
    >

    @include('livewire-forms::fields.label')

    @include('livewire-forms::fields.error')
</div>
