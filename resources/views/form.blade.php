<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @else
        @include('livewire-forms::components.form')
    @endif
</div>
