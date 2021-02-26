<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    <input
        @include('livewire-forms::fields.binding')
        id="{{ $field->getName() }}"
        type="checkbox"
        class="{{ $field->class ?? config('livewire-forms.defaults.inputClass') }}"
        name="{{ $field->getName() }}"
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    >

    @include('livewire-forms::fields.label')

    @includeWhen(
        $field->tooltip,
        'livewire-forms::components.tooltip',
        ['text' => $field->tooltip]
    )

    @include('livewire-forms::fields.error')
</div>
