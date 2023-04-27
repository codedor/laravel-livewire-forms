@error(($field->containsFile ? 'files.' : 'fields.') . $field->getName())
    @isset ($isCheckbox)
        <i class="fa-solid fa-triangle-exclamation me-1 fs-6 text-red"></i>
    @endisset

    <span @class(['form-error',
        'ms-1' => isset($inlined)
    ])>
        {{ $message }}
    </span>
@enderror
