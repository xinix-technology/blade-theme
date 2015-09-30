@extends('layout')

@section('content')
<h2>List {{ f('controller.name') }}</h2>

<div class="command-bar">
    <a href="{{ f('controller.url', '/null/create') }}">Create</a>
</div>

<div class="table-placeholder">

    <table>
        <thead>
            <tr>
                @if (f('app')->controller->schema())
                    @foreach(f('app')->controller->schema() as $name => $field)

                        <th>{{ $field->label(true) }}</th>

                    @endforeach
                @else
                    <th>Data</th>
                @endif

            </tr>
        </thead>
        <tbody>

            @if (count($entries))

                @foreach($entries as $entry)

                <tr>
                    @if (f('app')->controller->schema())
                        @foreach(f('app')->controller->schema() as $name => $field)

                        <td>
                            <a href="{{ f('controller.url', '/'.$entry['$id']) }}">
                                {{ $field->format('readonly', $entry[$name]) }}
                            </a>
                        </td>

                        @endforeach
                    @else
                        <td>{{ reset($entry) }}</td>
                    @endif

                </tr>

                <?php endforeach ?>
                <?php else: ?>

                <tr>
                    <td colspan="100">No record!</td>
                </tr>

            @endif

        </tbody>
    </table>
</div>
@endsection
