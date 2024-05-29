<fieldset>
    @if($field->legendTitle)
        <legend>{{ $field->legendTitle }}</legend>
    @endif

    @foreach ($field->getNestedFields() as $_field)
        {{ $_field->render() }}
    @endforeach
</fieldset>
