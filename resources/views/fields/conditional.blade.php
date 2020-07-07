<div class="{{ $field->divClass ?? 'col-12' }}">
    @foreach ($field->getFields() as $field)
        {{ $field->render() }}
    @endforeach
</div>
