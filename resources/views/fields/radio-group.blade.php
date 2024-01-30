<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    @include('livewire-forms::fields.gdpr')

    @include('livewire-forms::fields.label')

    @foreach ($field->options as $key => $value)
        <div
            @class([
                config('livewire-forms.defaults.radioInputGroupClass'),
                'is-invalid' => $errors->first(($field->containsFile ? 'files.' : 'fields.') . $field->getName()),
            ])
        >
            <input
                @include('livewire-forms::fields.binding')
                type="radio"
                @class([
                    $field->class ?? config('livewire-forms.defaults.checkInputClass'),
                    'is-invalid' => $errors->first(($field->containsFile ? 'files.' : 'fields.') . $field->getName()),
                ])
                id="{{ $field->getName() . '.' . $loop->index }}"
                name="{{ $field->getName() }}"
                value="{{ $field->useValueAsKeys ? $value : $key }}"
                @if ($field->dusk) dusk={{ $field->dusk }} @endif
            >
            <label
                class="{{ $field->checkOptionLabelClass ?? config('livewire-forms.defaults.checkOptionLabelClass') }} select-none"
                for="{{ $field->getName() . '.' . $loop->index }}"
            >
                {{ $value }}
            </label>
        </div>
    @endforeach

    @include('livewire-forms::fields.error')
</div>
