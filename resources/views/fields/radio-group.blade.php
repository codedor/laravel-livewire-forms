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
                  $field->checkDivClass ?? config('livewire-forms.defaults.checkDivClass')
                ])
            >
                <input
                    @include('livewire-forms::fields.binding')
                    type="radio"
                    @class([
                        $field->class ?? config('livewire-forms.defaults.checkInputClass'),
                        'is-invalid' => $errors->has('fields.' . $field->getName()),
                    ])
                    id="{{ $field->getName() . '.' . $loop->index }}"
                    name="{{ $field->getName() }}"
                    value="{{ $field->useValueAsKeys ? $value : $key }}"
                    @if ($field->dusk) dusk={{ $field->dusk }} @endif
                >
                <label
                    @class([config('livewire-forms.defaults.checkLabelClass')])
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
