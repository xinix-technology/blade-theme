@extends('layout')

@section('content')
<h2>Update {{ f('controller.name') }}</h2>

<form method="post">

    @foreach(f('app')->controller->schema() as $name => $field)

    @unless($field['hidden'])
        <div>
            {{ $field->label() }}
            {{ $field->format('input', @$entry[$name]) }}
        </div>
    @endunless

    @endforeach

    <div class="command-bar">
        <input type="submit">
        <a href="{{ f('controller.url') }}">List</a>
    </div>

</form>
@endsection
