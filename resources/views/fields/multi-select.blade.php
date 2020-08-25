<div class="{{ $field->divClass ?? 'col-6' }}">
    @include('livewire-forms::fields.label')

    <select
        @include('livewire-forms::fields.binding')
        id="{{ $field->getUniqueIdName() }}"
        class="{{ $field->class }}"
        name="{{ $field->getName() }}[]"
        @if($field->readOnly) disabled @endif
        multiple
    >
        @foreach ($field->options as $key => $value)
            <option
                value="{{ $field->useValueAsKeys ? $value : $key  }}"
                @if($field->getValue() == $key)
                    selected
                @endif
            >
                {{ $value }}
            </option>
        @endforeach
    </select>

    @include('livewire-forms::fields.error')
</div>