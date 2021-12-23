<div id="livewire-form">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @else
        @include('livewire-forms::components.step-list')
        @include('livewire-forms::components.form')
    @endif

    <script>
        window.addEventListener('form-event-tracking', event => {
            if (typeof window.gtag === 'function') {
                window.gtag('event', event.detail.event, {
                    event_category: event.detail.category,
                    ...(event.detail.label && { event_label: event.detail.label }),
                    ...(event.detail.value && { value: event.detail.value })
                })
            }
        })
    </script>
</div>
