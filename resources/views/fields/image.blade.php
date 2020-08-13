<div class="{{ $field->divClass ?? 'col-6' }}">
    @include('livewire-forms::fields.label')
    @if($field->getValue())
    <img
        class="{{ $field->class ?? 'img-fluid' }}"
        src="{{ optional($field->getValue())->getFormatOrOriginal($field->format)}}"
        alt="{{ $field->altText ?? optional($field->getValue())->name  }}"
        id="{{ $field->getName() }}"
        wire:model="files.{{ $field->getName() }}"
    >
    @endif
    @include('livewire-forms::fields.error')
</div>
