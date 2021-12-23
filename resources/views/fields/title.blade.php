<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    <{{ $field->tag ?? 'h2' }} class="{{ $field->headingClass ?? 'h2' }}">
        {{ $field->getLabel() ?? $field->getName() }}
    </{{ $field->tag ?? 'h2' }}>
</div>
