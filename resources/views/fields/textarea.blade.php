<div class="{{ $field->divClass ?? 'col-6' }}">
    @include('livewire-forms::fields.label')

    <textarea
        class="{{ $field->class }}"
        id="{{ $field->name }}"
        name="{{ $field->name }}"
        placeholder="{{ $field->label }}"
        wire:model.lazy="fields.{{ $field->name }}"
    ></textarea>

    @include('livewire-forms::fields.error')
</div>
