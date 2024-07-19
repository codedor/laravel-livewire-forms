<div @class([
    $field->divClass ?? config('livewire-forms.defaults.divClass'),
    $field->colClass ?? config('livewire-forms.defaults.colClass')])
>
    @include('livewire-forms::fields.label')

    <select
        @include('livewire-forms::fields.binding')
        id="{{ $field->getName() }}"
        name="{{ $field->getName() }}"
        @if($field->readOnly) disabled @endif
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
        @class([
            $field->class ?? config('livewire-forms.defaults.inputSelectClass'),
            'is-invalid' => $errors->has('fields.' . $field->getName()),
        ])
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
