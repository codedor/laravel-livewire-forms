<div class="{{ $field->divClass ?? 'col-6' }}">
    <button
        @if ($field->action)
            wire:click.prevent="{{ $field->action }}"
        @endif
        type="submit"
        name="{{ $field->getName() }}"
        value="{{ $field->getName() }}"
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    >
        {{ $field->getName() }}
    </button>
</div>
