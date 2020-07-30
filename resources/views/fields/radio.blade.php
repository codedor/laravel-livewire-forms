<div class="{{ $field->divClass ?? 'col-6' }} required">
     @foreach ($field->options as $key => $value)
        <div class="form-group custom-control custom-radio">
            <input
                type="radio"
                class="{{ $field->class }}"
                id="{{ $field->getName() . '.' . $loop->index }}"
                name="{{ $field->getName() }}"
                value="{{ $field->useValueAsKeys ? $value : $key }}"
                wire:model="fields.{{ $field->getName() }}"
            >
            <label class="{{$field->labelClass}} select-none" for="{{ $field->getName() . '.' . $loop->index }}">
                {{ $value }}
            </label>
        </div>
    @endforeach

    @include('livewire-forms::fields.error')
</div>
