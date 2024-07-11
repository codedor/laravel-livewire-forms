<div @class([
    $field->divClass ?? config('livewire-forms.defaults.divClass'),
    $field->colClass ?? config('livewire-forms.defaults.colClass')])
>
    @include('livewire-forms::fields.label')

    @if($field->getValue())
        <img
            class="{{ $field->class ?? 'img-fluid' }}"
            src="{{ isset($files_[$field->getName()]) ? $files_[$field->getName()]->temporaryUrl() : $field->getValue() }}"
            alt="{{ $field->altText ?? optional($field->getValue())->name  }}"
            id="{{ $field->getName() }}"
            @if ($field->dusk) dusk={{ $field->dusk }} @endif
        >
    @endif

    <input
        type="file"
        class="{{ $field->class }}"
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}"
        placeholder="{{ $field->getLabel() }}"
        wire:model="files.{{ $field->getName() }}"
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    >

    @include('livewire-forms::fields.gdpr')

    @include('livewire-forms::fields.error')
</div>
