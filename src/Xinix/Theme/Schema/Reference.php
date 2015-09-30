<?php namespace Xinix\Theme\Schema;

use Bono\App;
use Norm\Schema\Reference as NormReference;

class Reference extends NormReference
{
    public function formatReadonly($value, $entry = null)
    {
        $label = $this->formatPlain($value, $entry) ?: '&nbsp;';

        return App::getInstance()->theme->partial('_schema.string', array(
            'label'    => $this['label'],
            'name'     => $this['name'],
            'value'    => htmlentities($label),
            'readonly' => true,
            'entry'    => $entry,
        ));
    }

    public function label($plain = false)
    {
        return ($plain) ? $this['label'] : '<label>'.
            $this['label'] . (($this['filter-required']) ? ' <span class="mandatory-marker">*<span> ' : '').
        '</label>';
    }
}
