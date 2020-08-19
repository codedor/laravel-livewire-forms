<div class="{{ $field->divClass ?? 'col-6' }}">
    @include('livewire-forms::fields.label')

    <input
        type="file"
        class="{{ $field->class }}"
        id="{{ $field->getUniqueIdName() }}"
        name="{{ $field->getName() }}"
        placeholder="{{ $field->getLabel() }}"
        wire:model="files.{{ $field->getName() }}"
    >

    @include('livewire-forms::fields.error')
</div>
