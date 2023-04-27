<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    <div class="form-input-wrapper">
        @include('livewire-forms::fields.label', [
            'rules' => $field->rules
        ])

        <textarea
            @include('livewire-forms::fields.binding')
            id="{{ $field->getName() }}"
            class="form-control
                @error(($field->containsFile ? 'files.' : 'fields.') . $field->getName())
                    is-invalid
                @enderror
                {{ $field->class }}"
            name="{{ $field->getName() }}"
            placeholder="{{ $field->getLabel() }}"
            @if ($field->dusk) dusk={{ $field->dusk }} @endif
            rows="3"
        ></textarea>

        @include('livewire-forms::fields.error')
    </div>
</div>
