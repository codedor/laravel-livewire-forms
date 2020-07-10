<div>
    <input
        type="hidden"
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}"
        wire:model.lazy="fields.{{ $field->getName() }}"
    >
</div>
