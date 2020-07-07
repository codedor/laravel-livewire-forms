<div class="{{ $field->divClass ?? 'col-6' }}">
    @include('livewire-forms::fields.label')

    <select
        class="{{ $field->class }}"
        id="{{ $field->name }}"
        name="{{ $field->name }}"
        wire:model.lazy="fields.{{ $field->name }}"
    >
        <option value="">{{ __('form.select an option') }}</option>
        @foreach ($field->options as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>

    @include('livewire-forms::fields.error')
</div>
