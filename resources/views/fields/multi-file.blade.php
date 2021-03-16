<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    @include('livewire-forms::fields.label')

    <input
        type="file"
        class="{{ $field->class }}"
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}[]"
        placeholder="{{ $field->getLabel() }}"
        wire:model="files.{{ $field->getName() }}"
        multiple
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    >

    @includeWhen(
        $field->tooltip,
        'livewire-forms::components.tooltip',
        ['text' => $field->tooltip]
    )

    @include('livewire-forms::fields.error')
</div>
