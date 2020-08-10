<div class="{{ $field->divClass ?? 'col-6' }} form-group">
    <a
        href="{{ $field->getValue() }}"
        class="{{ $field->class }}"
        id="{{ $field->getName() }}"
        title="{{ $field->getName() }}"
        target="{{ $field->openNewTab ? '_blank' : 'self' }}"
        wire:model.lazy="fields.{{ $field->getName() }}"
    >
        {{ $field->label }}
    </a>

    @include('livewire-forms::fields.error')
</div>
