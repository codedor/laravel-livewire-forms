<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    @include('livewire-forms::fields.gdpr')

    @include('livewire-forms::fields.label')

    @foreach ($field->options as $key => $value)
        <div
            @class([
                config('livewire-forms.defaults.checkInputGroupClass'),
                'is-invalid' => $errors->first(($field->containsFile ? 'files.' : 'fields.') . $field->getName()),
            ])
        >
            <input
                type="checkbox"
                @class([
                    $field->classs ?? config('livewire-forms.defaults.checkInputClass'),
                    'is-invalid' => $errors->first(($field->containsFile ? 'files.' : 'fields.') . $field->getName()),
                ])
                id="{{ $field->getName() . '.' . $loop->index }}"
                name="{{ $field->getName() }}"
                wire:model.{{ $field->getDebounce() }}="fields.{{ $field->getName() }}.{{ $key }}"
            >
            <label
                @class([
                    'select-none',
                    $field->checkOptionLabelClass ?? config('livewire-forms.defaults.checkOptionLabelClass'),
                ])
                for="{{ $field->getName() . '.' . $loop->index }}"
            >
                {{ $value }}
            </label>
        </div>
    @endforeach

    @include('livewire-forms::fields.error')
</div>
