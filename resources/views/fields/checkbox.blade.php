<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    <div class="form-check">
        <input
            @include('livewire-forms::fields.binding')
            id="{{ $field->getName() }}"
            type="checkbox"
            class="form-check-input
                @error(($field->containsFile ? 'files.' : 'fields.') . $field->getName())
                    is-invalid
                @enderror
                {{ $field->class ?? config('livewire-forms.defaults.inputClass') }}"
            name="{{ $field->getName() }}"
            @if ($field->dusk) dusk={{ $field->dusk }} @endif
        >

        @include('livewire-forms::fields.label', [
            'isCheckbox' => true
        ])

        @include('livewire-forms::fields.gdpr')
    </div>

    @include('livewire-forms::fields.error', [
        'isCheckbox' => true
    ])
</div>
