<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    @include('livewire-forms::fields.label')

    <textarea
        @include('livewire-forms::fields.binding')
        id="{{ $field->getName() }}"
        class="{{ $field->class }}"
        name="{{ $field->getName() }}"
        placeholder="{{ $field->getLabel() }}"
    ></textarea>

    @includeWhen(
        $field->tooltip,
        'livewire-forms::components.tooltip',
        ['text' => $field->tooltip]
    )

    @include('livewire-forms::fields.error')
</div>
