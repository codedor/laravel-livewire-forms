@if ($field->step === session('step'))
    @foreach ($field->fields as $_field)
        {{ $_field->render() }}
    @endforeach
@endif
