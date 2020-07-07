<div class="row">
    @foreach ($field->fields as $_field)
        {{ $_field->render() }}
    @endforeach
</div>
