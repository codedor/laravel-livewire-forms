<div class="{{ $field->divClass ?? 'row' }}">
    @foreach ($field->getNestedFields() as $_field)
        {{ $_field->render() }}
    @endforeach
</div>
