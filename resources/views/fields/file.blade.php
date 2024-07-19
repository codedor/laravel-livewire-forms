<div @class([
    $field->divClass ?? config('livewire-forms.defaults.divClass'),
    $field->colClass ?? config('livewire-forms.defaults.colClass')])
>
    @include('livewire-forms::fields.label')

    <input
        type="file"
        @class([
            $field->class ?? config('livewire-forms.defaults.inputClass'),
            'is-invalid' => $errors->has('fields.' . $field->getName()),
        ])
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}"
        placeholder="{{ $field->getLabel() }}"
        wire:model="files.{{ $field->getName() }}"
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    >

    @include('livewire-forms::fields.gdpr')

    @include('livewire-forms::fields.error')
</div>
