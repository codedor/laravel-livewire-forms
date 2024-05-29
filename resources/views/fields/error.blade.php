@error(($field->containsFile ? 'files.' : 'fields.') . $field->getName())
<span class="invalid-feedback">
    {{ $message }}
</span>
@enderror
