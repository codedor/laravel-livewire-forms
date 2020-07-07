<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @else
        <form wire:submit.prevent="submit">
            @foreach($form::fields() as $field)
                {{ optional($field)->render() }}
            @endforeach
        </form>
    @endif
</div>
