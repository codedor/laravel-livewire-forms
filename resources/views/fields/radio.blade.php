<div class="{{ $field->divClass ?? 'col-6' }} form-group required">
     @foreach ($field->options as $value => $label)
    <label class="flex items-center select-none" for="{{ $field->name . '.' . $loop->index }}">
        <input
            type="radio"
            class="{{ $field->class }}"
            id="{{ $field->name . '.' . $loop->index }}"
            name="{{ $field->name }}"
            value="{{ $value }}"
            wire:model="fields.{{ $field->name }}"
        >
        {{ $label }}
    </label>
    @endforeach
@dump($field->default)

    @include('livewire-forms::fields.error')
</div>
