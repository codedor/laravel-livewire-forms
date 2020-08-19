<label
    for="{{ $field->getUniqueIdName() }}"
    class="{{ $field->labelClass }} {{ ($field->getValue() ? 'changed' : '') }}"
>
    {{ $field->getLabel() }}
</label>
