<select name="{{ lcfirst($self['name']) }}">
    <option value="" disabled>&mdash; Select one {{ $self['label'] }} &mdash;</option>
    @foreach ($entries as $entry)
        <option value="{{ $entry['key'] }}" {{ ($entry['key'] == $value) ? 'selected' : '' }}>
            {{ $entry[$self->get('foreignLabel')] }}
        </option>
    @endforeach
</select>
