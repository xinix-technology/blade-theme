@extends('layout')

@section('content')
<h2>Show {{ f('controller.name') }}</h2>

<form method="post">

    @foreach(f('app')->controller->schema() as $name => $field)
        @if (!$field['hidden'])
            <div>
                {{ $field->label() }}
                {{ $field->format('readonly', @$entry[$name]) }}
            </div>
        @endif

    @endforeach

    <div class="command-bar">
        <a href="{{ f('controller.url') }}">List</a>
        <a href="{{ f('controller.url', '/:id/update') }}">Update</a>
        <a href="{{ f('controller.url', '/:id/delete') }}">Delete</a>
    </div>

</form>
@endsection
