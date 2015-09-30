<?php use Xinix\Theme\Helper\SchemaHelper; ?>
<select name="{{ $self['name'] }}" data-value="{{ @$value }}">
    <option value="" disabled>&mdash; Select one {{ $self['label'] }} &mdash;</option>
    @foreach ($self->findOptions() as $key => $entry)
        <?php $entryValue = SchemaHelper::getReferenceValue($entry, $self); ?>
        <option value="{{ $entryValue }}" {{ ($entryValue == $value ? 'selected' : '') }}>
            {{ SchemaHelper::getLabel($entry, $self) }}
        </option>
    @endforeach
</select>
