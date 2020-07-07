<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @else
        <ul>
            @foreach($form::fields() as $formStep)
                @if (isset($formStep->step))
                    <li>
                        <a
                            href="#"
                            wire:click.prevent="goToStep({{ $formStep->step }})"
                        >
                            {{ $formStep->step }} - {{ $formStep->title }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>

        <form wire:submit.prevent="submit">
            @foreach($form::fields() as $field)
                {{ optional($field)->render() }}
            @endforeach
        </form>
    @endif
</div>
