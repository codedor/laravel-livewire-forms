<div>
    <input
        type="hidden"
        id="{{ $field->name }}"
        name="{{ $field->name }}"
        wire:model.lazy="fields.{{ $field->name }}"
    >
</div>
