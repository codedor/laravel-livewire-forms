@if ($field->getLabel())
    @php
        $isRequired = is_array($field->rules)
            ? in_array('required', $field->rules)
            : ($field->rules === 'required' || $field->rules === 'accepted');
    @endphp

    <label
        for="{{ $field->getName() }}"
        @class([
            $field->labelClass ?? config('livewire-forms.defaults.labelClass'),
            ($field->getValue() ? 'changed' : ''),
            'required' => $isRequired
        ])
    >
        {!! strip_tags($field->getLabel(), ['a', 'sup', 'sub', 'strong', 'em', 'u', 's']) !!}
    </label>
@endif
