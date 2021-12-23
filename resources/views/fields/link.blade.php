<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    <a
        href="{{ $field->getValue() }}"
        class="{{ $field->class }}"
        title="{{ $field->getName() }}"
        @if ($field->target) target="{{ $field->target }}" @endif
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    >
        {{ $field->getLabel() }}
    </a>

    @include('livewire-forms::fields.gdpr')

    @include('livewire-forms::fields.error')
</div>
