<fieldset
    @class([
      $field->groupClass ?? config('livewire-forms.defaults.groupClass'),
      $field->colClass ?? config('livewire-forms.defaults.colClass'),
      $field->gapClass ?? config('livewire-forms.defaults.gapClass')
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
