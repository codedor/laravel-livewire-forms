<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    @include('livewire-forms::fields.label')

    <select
        @include('livewire-forms::fields.binding')
        id="{{ $field->getName() }}"
        class="{{ $field->class }}"
        name="{{ $field->getName() }}[]"
        @if($field->readOnly) disabled @endif
        multiple
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    >
        @foreach ($field->options as $key => $value)
            <option
                value="{{ $field->useValueAsKeys ? $value : $key  }}"
                @if(in_array($key, $field->getValue()))
                    selected
                @endif
            >
                {{ $value }}
            </option>
        @endforeach
    </select>

    @includeWhen(
        $field->tooltip,
        'livewire-forms::components.tooltip',
        ['text' => $field->tooltip]
    )

    @include('livewire-forms::fields.error')
</div>
