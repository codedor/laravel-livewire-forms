<div>
    <input
        @include('livewire-forms::fields.binding')
        id="{{ $field->getName() }}"
        type="hidden"
        name="{{ $field->getName() }}"
        value="{{ $field->getValue() }}"
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    >
</div>
