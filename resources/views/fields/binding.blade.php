@if ($field->getBinding() === 'livewire')
    wire:model.{{ $field->getDebounce() }}="fields.{{ $field->getName() }}"
@elseif ($field->getBinding() === 'vue')
    :v-model="slot.fields.{{ $field->getName() }}"
@endif
