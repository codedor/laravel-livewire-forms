<div
    @class([
      $field->divClass ?? config('livewire-forms.defaults.divClass'),
      $field->colClass ?? config('livewire-forms.defaults.colClass')
   ])
>
    @include('livewire-forms::fields.label')

    <div @class([
        'd-flex flex-column',
        $field->checkGapClass ?? config('livewire-forms.defaults.checkGapClass')
    ])>
        @foreach ($field->options as $key => $value)
            <div
                @class([
                    $field->checkDivClass ?? config('livewire-forms.defaults.checkDivClass'),
                    'is-invalid' => $errors->first(($field->containsFile ? 'files.' : 'fields.') . $field->getName()),
                ])
            >
                <input
                    type="checkbox"
                    @class([
                        $field->class ?? config('livewire-forms.defaults.checkInputClass'),
                        'is-invalid' => $errors->first(($field->containsFile ? 'files.' : 'fields.') . $field->getName()),
                    ])
                    id="{{ $field->getName() . '.' . $loop->index }}"
                    name="{{ $field->getName() }}"
                    wire:model.{{ $field->getDebounce() }}="fields.{{ $field->getName() }}.{{ $key }}"
                >
                <label
                    @class([
                        'select-none',
                        $field->checkOptionLabelClass ?? config('livewire-forms.defaults.checkLabelClass'),
                    ])
                    for="{{ $field->getName() . '.' . $loop->index }}"
                >
                    {{ $value }}
                </label>
            </div>
        @endforeach
    </div>

    @include('livewire-forms::fields.gdpr')
    @include('livewire-forms::fields.error')
</div>
