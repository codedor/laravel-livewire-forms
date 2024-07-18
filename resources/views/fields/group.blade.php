<fieldset
    @class([
      $field->colClass ?? config('livewire-forms.defaults.colClass'),
      $field->groupClass ?? config('livewire-forms.defaults.groupClass')
    ])
>
    @if($field->legendTitle)
        <legend>{{ $field->legendTitle }}</legend>
    @endif

    @foreach ($field->getNestedFields() as $_field)
        {{ $_field->render() }}
    @endforeach
</fieldset>
i
