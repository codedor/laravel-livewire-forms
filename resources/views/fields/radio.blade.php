<div class="{{ $field->divClass ?? 'col-6' }} form-group required">
     @foreach ($field->options as $value => $label)
    <label class="flex items-center select-none" for="{{ $field->getName() . '.' . $loop->index }}">
        <input
            type="radio"
            class="{{ $field->class }}"
            id="{{ $field->getName() . '.' . $loop->index }}"
            name="{{ $field->getName() }}"
            value="{{ $value }}"
            wire:model="fields.{{ $field->getName() }}"
        >
        {{ $label }}
    </label>
    @endforeach

    @include('livewire-forms::fields.error')
</div>
