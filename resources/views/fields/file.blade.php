<div class="{{ $field->divClass ?? 'col-6' }}">
    @include('livewire-forms::fields.label')

    <input
        type="file"
        class="{{ $field->class }}"
        id="{{ $field->name }}"
        name="{{ $field->name }}"
        placeholder="{{ $field->label }}"
        wire:model="{{ $field->name }}"
    >

    @include('livewire-forms::fields.error')
</div>
