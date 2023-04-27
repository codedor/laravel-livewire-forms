@php
    if (isset($label)) $label;

    $required = false;
    if (isset($field->rules) && is_array($field->rules)) {
        $index = array_search('required', $field->rules);
        if (is_int($index)) {
            $required = $field->rules[$index] === 'required';
        }
    } elseif (isset($field->rules)) {
        $required = $field->rules === 'required';
    }
@endphp

@if (! $field->hideLabel)
    <div class="d-inline-flex gap-x-2 justify-content-between align-items-center w-100">
        <label
            for="{{ isset($label) ? str_replace(' ', '', $label) : $field->getName() }}"
            @class([$field->labelClass,
                'changed' => $field->getValue(),
                isset($isCheckbox) ? 'form-check-label' : 'form-label'])
        >
            @if (isset($label))
                <span>
                    {{ $label }}
                    @if ($required)
                        <span class="text-danger">*</span>
                    @endif
                </span>
            @else
                <span>{!! $field->getLabel() !!}</span>
                @if ($required)
                    <span class="text-danger">*</span>
                @endif
            @endif
        </label>

        @include('livewire-forms::fields.gdpr')
    </div>
@endif
