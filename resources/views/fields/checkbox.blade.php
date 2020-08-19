<div class="{{ $field->divClass ?? 'col-6' }} form-group required">
    <input
        @include('livewire-forms::fields.binding')
        id="{{ $field->getUniqueIdName() }}"
        type="checkbox"
        class="{{ $field->class }}"
        name="{{ $field->getName() }}"
    >

    @include('livewire-forms::fields.label')

    @include('livewire-forms::fields.error')
</div>
