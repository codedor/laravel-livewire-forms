<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    @include('livewire-forms::fields.label')

    <textarea
        @include('livewire-forms::fields.binding')
        id="{{ $field->getName() }}"
        class="{{ $field->class }}"
        name="{{ $field->getName() }}"
        placeholder="{{ $field->getLabel() }}"
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    ></textarea>

    @include('livewire-forms::fields.gdpr')

    @include('livewire-forms::fields.error')
</div>
