<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    <div class="form-input-wrapper">
        @include('livewire-forms::fields.label', [
            'rules' => $field->rules
        ])

        @if ($field->getValue())
            <img
                class="{{ $field->class ?? 'img-fluid' }}"
                src="{{ isset($files_[$field->getName()])
                    ? $files_[$field->getName()]->temporaryUrl()
                    : $field->getValue() }}"
                alt="{{ $field->altText ?? optional($field->getValue())->name  }}"
                id="{{ $field->getName() }}"
                @if ($field->dusk) dusk={{ $field->dusk }} @endif
            >
        @endif

        <input
            @include('livewire-forms::fields.binding')
            id="{{ $field->getName() }}"
            type="file"
            class="form-control
                @error(($field->containsFile ? 'files.' : 'fields.') . $field->getName())
                    is-invalid
                @enderror
                {{ $field->class ?? config('livewire-forms.defaults.inputClass') }}"
            name="{{ $field->getName() }}"
            placeholder="{{ $field->getLabel() }}"
            value="{{ $field->getValue() }}"
            wire:model="files.{{ $field->getName() }}"
            @if ($field->props) {{ $field->props }} @endif
            @if ($field->readOnly) disabled @endif
            @if ($field->dusk) dusk={{ $field->dusk }} @endif
        >

        @include('livewire-forms::fields.error')
    </div>
</div>

