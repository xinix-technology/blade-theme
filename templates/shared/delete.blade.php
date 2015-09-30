@extends('layout')

@section('content')
<h2>Delete {{ f('controller.name') }}</h2>

<form method="post">

    <p>Are you sure?</p>

    <div class="command-bar">
        <input type="submit" value="Yes">
        <a href="javascript:history.back()">No</a>
        <a href="{{ f('controller.url') }}">List</a>
    </div>

</form>
@endsection
