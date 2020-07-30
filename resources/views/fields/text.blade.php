<div class="{{ $field->divClass ?? 'col-6' }}">
    @include('livewire-forms::fields.label')

    <input
        type="{{ $field->type ?? 'text' }}"
        class="{{ $field->class }}"
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}"
        placeholder="{{ $field->getLabel() }}"
        wire:model.lazy="fields.{{ $field->getName() }}"
        @if($field->readOnly)
        disabled
        @endif
    >

    @include('livewire-forms::fields.error')
</div>
