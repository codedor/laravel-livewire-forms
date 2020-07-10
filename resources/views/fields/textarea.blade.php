<div class="{{ $field->divClass ?? 'col-6' }}">
    @include('livewire-forms::fields.label')

    <textarea
        class="{{ $field->class }}"
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}"
        placeholder="{{ $field->label }}"
        wire:model.lazy="fields.{{ $field->getName() }}"
    ></textarea>

    @include('livewire-forms::fields.error')
</div>
