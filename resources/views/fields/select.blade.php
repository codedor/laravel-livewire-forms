<div class="{{ $field->divClass ?? 'col-6' }}">
    @include('livewire-forms::fields.label')
    <select
        class="{{ $field->class }}"
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}"
        wire:model.lazy="fields.{{ $field->getName() }}"
        @if($field->readOnly)
        disabled
        @endif
    >
        <option value="">{{ __('form.select an option') }}</option>
        @foreach ($field->options as $key => $value)
            <option
                value="{{ $field->useValueAsKeys ? $value : $key  }}"
                @if($field->default === $key)
                selected
                @endif
            >
                {{ $value }}
            </option>
        @endforeach
    </select>

    @include('livewire-forms::fields.error')
</div>