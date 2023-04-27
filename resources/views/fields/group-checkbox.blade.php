<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    @if ($field->groupLabel)
        <label class="form-label mb-1">
            {{ $field->groupLabel }}
        </label>
    @endif

    <div class="form-check-group">
        @foreach($field->options as $key => $option)
            <div class="form-check {{ ($field->getValue()[$option] ?? false ? 'changed' : '') }}">
                <input
                    wire:model.lazy="fields.{{ $field->getName() }}.{{ $option }}"
                    id="{{ $option }}"
                    type="checkbox"
                    class="form-check-input {{ $field->class ?? config('livewire-forms.defaults.inputClass') }}"
                    @if ($field->dusk) dusk={{ $field->dusk }} @endif
                >
                <label
                    for="{{ $option }}"
                    class="form-check-label {{ $field->labelClass }}"
                >
                    {{ $key }}
                </label>
            </div>
        @endforeach

        @include('livewire-forms::fields.gdpr')
    </div>

    @include('livewire-forms::fields.error', [
        'isCheckbox' => true
    ])
</div>
