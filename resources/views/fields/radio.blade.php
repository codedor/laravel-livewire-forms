<div class="{{ $field->divClass ?? 'col-6' }} form-group required">
     @foreach ($field->options as $key => $value)
    <label class="flex items-center select-none">
    <input
        type="radio"
        class="{{ $field->class }}"
        id="{{ $field->name }}"
        name="{{ $field->name }}"
        wire:model.lazy="fields.{{ $field->name }}"
    >
        {{ $value }}
    </label>
    @endforeach

    @include('livewire-forms::fields.label')

    @include('livewire-forms::fields.error')
</div>
