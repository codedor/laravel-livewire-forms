<form wire:submit.prevent="submit">
    @foreach($form::fields() as $field)
        {{ optional($field)->render() }}
    @endforeach
</form>
