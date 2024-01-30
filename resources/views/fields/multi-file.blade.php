<div class="{{ $field->divClass ?? config('livewire-forms.defaults.divClass') }}">
    @include('livewire-forms::fields.label')

    <div
        @class([
            $field->fileInputWrapperClass ?? config('livewire-forms.defaults.fileInputWrapperClass')
            'is-invalid' => $errors->first(($field->containsFile ? 'files.' : 'fields.') . $field->getName()),
        ])
    >
        <input
            type="file"
            @class([
                $field->class ?? config('livewire-forms.defaults.fileInputClass')
            ])
            id="{{ $field->getName() }}"
            name="{{ $field->getName() }}[]"
            placeholder="{{ $field->getLabel() }}"
            wire:model="files.{{ $field->getName() }}"
            multiple
            @if ($field->dusk) dusk={{ $field->dusk }} @endif
        >

        {{ __('form.choose a file') }}
    </div>

    @if (! ($field->hideUploadedFiles() ?? false))
        @if(! empty($files_) && isset($files_[$field->getName()]))
            <div @class([
                $field->fileInputUploadedClass ?? config('livewire-forms.defaults.fileInputUploadedClass'),
            ])>
                <ul @class([
                    $field->fileInputUploadedListClass ?? config('livewire-forms.defaults.fileInputUploadedListClass'),
                ])>
                    @foreach ($files_[$field->getName()] as $file)
                        <li>
                            <i aria-hidden="true" class="far fa-file me-1"></i>
                            <span>
                                {{ $file->getClientOriginalName() }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endif

    @include('livewire-forms::fields.gdpr')

    @include('livewire-forms::fields.error')
</div>
