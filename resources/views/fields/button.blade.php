<div class="{{ $field->divClass ?? 'col-6' }}">
    <input
        @if ($field->action)
            wire:click.prevent="{{ $field->action }}()"
        @endif
        type="submit"
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}"
        value="{{ $field->getName() }}"
    >
</div>
