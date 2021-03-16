<div class="{{ $field->divClass ?? 'col-12' }}">
    <{{ $field->tag ?? 'h2' }} class="{{ $field->headingClass ?? 'h2' }}">
        {{ $field->getLabel() ?? $field->getName() }}
    </{{ $field->tag ?? 'h2' }}>
</div>
