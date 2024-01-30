@php
    $field->labelClass = $field->checkOptionLabelClass ?? config('livewire-forms.defaults.checkOptionLabelClass') ;
    $field->required = $field->rules === 'accepted';
@endphp
    <input
        @include('livewire-forms::fields.binding')
        id="{{ $field->getName() }}"
        type="checkbox"
        @class([
            $field->class ?? config('livewire-forms.defaults.checkInputClass'),
            'is-invalid' => $errors->first(($field->containsFile ? 'files.' : 'fields.') . $field->getName()),
        ])
        name="{{ $field->getName() }}"
        @if ($field->dusk) dusk={{ $field->dusk }} @endif
    >

    @include('livewire-forms::fields.label')

    @include('livewire-forms::fields.gdpr')

    @include('livewire-forms::fields.error')
</div>
