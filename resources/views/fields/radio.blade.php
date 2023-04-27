<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    <div class="form-check-group">
        @foreach ($field->options as $key => $value)
            <div class="form-check">
                <input
                    @include('livewire-forms::fields.binding')
                    type="radio"
                    class="form-check-input
                        @error(($field->containsFile ? 'files.' : 'fields.') . $field->getName())
                            is-invalid
                        @enderror
                        {{ $field->class }}"
                    id="{{ $field->getName() . '.' . $loop->index }}"
                    name="{{ $field->getName() }}"
                    value="{{ $field->useValueAsKeys ? $value : $key }}"
                    @if ($field->dusk) dusk={{ $field->dusk }} @endif
                >
                <label
                    class="form-check-label {{$field->labelClass}} select-none"
                    for="{{ $field->getName() . '.' . $loop->index }}"
                >
                    {{ $value }}
                </label>
            </div>
        @endforeach

        @include('livewire-forms::fields.gdpr')
    </div>

    @include('livewire-forms::fields.error', [
        'isCheckbox' => true
    ])
</div>
