<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    @if ($field->tag === 'p')
        <div class="{{ $field->class ?? config('livewire-forms.defaults.titleClass') }}">
            {{ $field->getLabel() ?? $field->getName() }}
        </div>
    @else
        <{{ $field->tag ?? 'h2' }}
            @class([
                $field->class ?? config('livewire-forms.defaults.titleClass'),
                $field->headingClass ?? 'h2'
            ])
        >
            {{ strip_tags($field->getLabel() ?? $field->getName()) }}
        </{{ $field->tag ?? 'h2' }}>
    @endif
</div>
