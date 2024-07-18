<div
    @class([
      $field->divClass ?? config('livewire-forms.defaults.divClass'),
      $field->colClass ?? config('livewire-forms.defaults.colClass')
    ])
>
    <div class="form-check">
        <input
            @include('livewire-forms::fields.binding')
            id="{{ $field->getName() }}"
            type="checkbox"
            @class([
                $field->class ?? config('livewire-forms.defaults.checkInputClass'),
                'is-invalid' => $errors->has('fields.' . $field->getName()),
            ])
            name="{{ $field->getName() }}"
            @if ($field->dusk) dusk={{ $field->dusk }} @endif
        >

        <label @class([config('livewire-forms.defaults.checkLabelClass')]) for="{{ $field->getName() }}">
            {!! $field->getLabel() !!}
        </label>
    </div>

    @include('livewire-forms::fields.gdpr')

    @include('livewire-forms::fields.error')
</div>
