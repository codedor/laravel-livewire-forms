@if ($field->gdpr)
    <button aria-label="GDPR info label" type="button" class="gdpr-field">
        <span class="gdpr-icon">
            {!! $field->gdprIcon ?? '?' !!}
        </span>

        <span class="gdpr-info">
            {{ $field->gdpr }}
        </span>
    </button>
@endif
