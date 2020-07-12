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
                            {{ $formStep->step }} - {{ $formStep->name }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>

        @include('livewire-forms::components.form')
    @endif
</div>
