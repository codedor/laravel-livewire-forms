<div class="{{ $field->divClass ?? 'col-6' }} form-group">
    <a
        id="{{ $field->getUniqueIdName() }}"
        href="{{ $field->getValue() }}"
        class="{{ $field->class }}"
        title="{{ $field->getName() }}"
        @if ($field->target) target="{{ $field->target }}" @endif
    >
        {{ $field->label }}
    </a>

    @include('livewire-forms::fields.error')
</div>
