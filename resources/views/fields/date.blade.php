<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    @include('livewire-forms::fields.label')

    <input
        @include('livewire-forms::fields.binding')
        id="{{ $field->getName() }}"
        type="date"
        class="{{ $field->class }}"
        name="{{ $field->getName() }}"
        placeholder="{{ $field->getLabel() }}"
        @if($field->readOnly) disabled @endif
        value="{{ $field->getValue() }}"
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    >

    @includeWhen(
        $field->tooltip,
        'livewire-forms::components.tooltip',
        ['text' => $field->tooltip]
    )

    @include('livewire-forms::fields.error')
</div>
