@if ($field->step === session('step'))
    @foreach ($field->getNestedFields() as $_field)
        {{ $_field->render() }}
    @endforeach
@endif
