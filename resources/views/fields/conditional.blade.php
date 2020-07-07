<div class="{{ $field->divClass ?? 'col-12' }}">
    @if(session('formFields')[$field->checkField] === $field->checkValue)
        @foreach ($field->hiddenFields as $field)
            {{ $field->render() }}
        @endforeach
    @endif
</div>
