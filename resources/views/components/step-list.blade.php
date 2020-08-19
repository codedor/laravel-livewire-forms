<ul>
    @foreach($form->fields as $formStep)
        @if (isset($formStep->step))
            <li class="{{ ($step === $formStep->step) ? 'active' : '' }}">
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
