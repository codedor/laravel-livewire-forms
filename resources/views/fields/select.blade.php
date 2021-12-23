<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    @include('livewire-forms::fields.label')
    <select
        @include('livewire-forms::fields.binding')
        id="{{ $field->getName() }}"
        class="{{ $field->class }}"
        name="{{ $field->getName() }}"
        @if($field->readOnly) disabled @endif
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    >
        <option value="">{{ __('form.select an option') }}</option>
        @foreach ($field->options as $key => $value)
            <option value="{{ $field->useValueAsKeys ? $value : $key }}">
                {{ $value }}
            </option>
        @endforeach
    </select>

    @include('livewire-forms::fields.gdpr')

    @include('livewire-forms::fields.error')
</div>
