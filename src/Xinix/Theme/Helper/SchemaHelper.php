<?php namespace Xinix\Theme\Helper;

class SchemaHelper
{
    public static function getReferenceValue($entry, $schema)
    {
        if (is_string($entry)) {
            $entryValue = $entry;
        } else {
            $entryValue = $entry[$schema['foreignKey']];
        }

        return $entryValue;
    }

    public static function getLabel($entry, $schema)
    {
        if (is_string($entry)) {
            $label = $entry;
        } elseif (is_callable($schema['foreignLabel'])) {
            $getLabel = $schema['foreignLabel'];
            $label = $getLabel($entry);
        } else {
            $label = $entry[$schema['foreignLabel']];
        }

        return $label;
    }
}
