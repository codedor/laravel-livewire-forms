@if ($field->gdpr)
    <button @class(['btn--gdpr', 'ms-1' => isset($inlined)]) aria-label="GDPR info label" type="button">
        <i class="fal fa-circle-info gdpr-icon" aria-hidden="true"></i>
        <span class="gdpr-info">{{ $field->gdpr }}</span>
    </button>
@endif
