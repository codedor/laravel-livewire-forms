<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
     @foreach ($field->options as $key => $value)
        <div class="form-group custom-control custom-radio">
            <input
                @include('livewire-forms::fields.binding')
                type="radio"
                class="{{ $field->class }}"
                id="{{ $field->getName() . '.' . $loop->index }}"
                name="{{ $field->getName() }}"
                value="{{ $field->useValueAsKeys ? $value : $key }}"
                @if ($field->dusk) dusk={{ $field->dusk }} @endif
            >
            <label
                class="{{$field->labelClass}} select-none"
                for="{{ $field->getName() . '.' . $loop->index }}"
            >
                {{ $value }}
            </label>
        </div>
    @endforeach

    @includeWhen(
        $field->tooltip,
        'livewire-forms::components.tooltip',
        ['text' => $field->tooltip]
    )

    @include('livewire-forms::fields.error')
</div>
