<form
    wire:submit.prevent="submit"
    @class([
        $field->formClass ?? config('livewire-forms.defaults.formClass'),
        $field->gapClass ?? config('livewire-forms.defaults.gapClass')
    ])
>
    @foreach($form->fields as $field)
        {{ optional($field)->render() }}
    @endforeach
</form>
