<form wire:submit.prevent="submit">
    @foreach($form::fields() as $field)
        {{ $field->getName() }}
        {{ optional($field)->render() }}
    @endforeach
</form>
