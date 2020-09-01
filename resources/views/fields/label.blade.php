<label
    for="{{ $field->getName() }}"
    class="{{ $field->labelClass }} {{ ($field->getValue() ? 'changed' : '') }}"
>
    {{ $field->getLabel() }}
</label>
