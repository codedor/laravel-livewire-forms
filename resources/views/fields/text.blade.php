<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    <div class="form-input-wrapper">
        @include('livewire-forms::fields.label', [
            'rules' => $field->rules
        ])

        <input
            @include('livewire-forms::fields.binding')
            id="{{ $field->getName() }}"
            type="{{ $field->type ?? 'text' }}"
            class="form-control
                @error(($field->containsFile ? 'files.' : 'fields.') . $field->getName())
                    is-invalid
                @enderror
                {{ $field->class ?? config('livewire-forms.defaults.inputClass') }}"
            name="{{ $field->getName() }}"
            placeholder="{{ $field->getLabel() }}"
            value="{{ $field->getValue() }}"
            @if ($field->props) {{ $field->props }} @endif
            @if ($field->readOnly) disabled @endif
            @if ($field->dusk) dusk={{ $field->dusk }} @endif
        >

        @include('livewire-forms::fields.error')
    </div>
</div>
