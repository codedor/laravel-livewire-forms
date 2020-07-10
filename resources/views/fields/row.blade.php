<div class="{{ $field->divClass ?? 'row' }}">
    @foreach ($field->fields as $_field)
        {{ $_field->render() }}
    @endforeach
</div>
