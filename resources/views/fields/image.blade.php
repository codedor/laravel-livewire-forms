<div class="{{ $field->divClass ?? 'col-6' }}">
    @include('livewire-forms::fields.label')

    @if($field->getValue())
    <img
        class="{{ $field->class ?? 'img-fluid' }}"
        src="{{ isset($files_[$field->getName()]) ? $files_[$field->getName()]->temporaryUrl() : $field->getValue() }}"
        alt="{{ $field->altText ?? optional($field->getValue())->name  }}"
        id="{{ $field->getName() }}"
    >
    @endif
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
