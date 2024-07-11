<form
    wire:submit.prevent="submit"
    @class([
        $field->formClass ?? config('livewire-forms.defaults.formClass')
    ])
>
    @foreach($form->fields as $field)
        {{ optional($field)->render() }}
    @endforeach
</form>
