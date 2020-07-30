<label
    for="{{ $field->getName() }}"
    class="{{ $field->labelClass }} {{ ($field->getValue() ? 'changed' : '') }}"
>
    {{ $field->label }}
</label>
