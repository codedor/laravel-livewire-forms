<form wire:submit.prevent="submit">
    @foreach($form::getFields() as $field)
        {{ optional($field)->render() }}
    @endforeach
</form>
