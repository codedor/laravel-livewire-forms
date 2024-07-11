<div @class([
    $field->divClass ?? config('livewire-forms.defaults.divClass'),
    $field->colClass ?? config('livewire-forms.defaults.colClass')])
>
    <button
        @if ($field->action)
            wire:click.prevent="{{ $field->action }}"
        @endif
        type="submit"
        name="{{ $field->getName() }}"
        @class([$field->class ?? config('livewire-forms.defaults.buttonClass')])
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    >
        {{ $field->getName() }}
        @if($buttonIcon)
            <x-dynamic-component component="{{ $field->buttonIcon ?? config('livewire-forms.defaults.buttonIcon') }}" />
        @endif
    </button>
</div>
