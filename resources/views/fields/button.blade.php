<div @class([$field->divClass ?? config('livewire-forms.defaults.divClass')])>
    <input
        @if ($field->action)
            wire:click.prevent="{{ $field->action }}"
        @endif
        type="submit"
        name="{{ $field->getName() }}"
        value="{{ $field->getName() }}"
        @class([$field->class ?? config('livewire-forms.defaults.buttonClass')])
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    >
</div>
