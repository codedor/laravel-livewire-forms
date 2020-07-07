<div class="{{ $field->divClass ?? 'col-6' }}">
    <input
        @if ($field->action)
            wire:click.prevent="{{ $field->action }}()"
        @endif
        type="submit"
        id="{{ $field->name }}"
        name="{{ $field->name }}"
        value="{{ $field->name }}"
    >
</div>
