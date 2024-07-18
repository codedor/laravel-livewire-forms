<div @class([
    $field->divClass ?? config('livewire-forms.defaults.divClass'),
    $field->colClass ?? config('livewire-forms.defaults.colClass')])
>
    <a
        href="{{ $field->getValue() }}"
        class="{{ $field->class ?? config('livewire-forms.defaults.linkClass') }}"
        title="{{ $field->getName() }}"
        @if ($field->target) target="{{ $field->target }}" @endif
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    >
        {{ $field->getLabel() }}
    </a>

    @include('livewire-forms::fields.gdpr')

    @include('livewire-forms::fields.error')
</div>
