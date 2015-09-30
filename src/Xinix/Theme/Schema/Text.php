<?php namespace Xinix\Theme\Schema;

use Bono\App;
use Norm\Schema\Text as NormText;

class Text extends NormText
{
    public function formatInput($value, $entry = null)
    {
        return App::getInstance()->theme->partial($this->getPartialTemplate(), array(
            'label'    => $this['label'],
            'name'     => $this['name'],
            'value'    => htmlentities($value),
            'readonly' => false,
            'entry'    => $entry,
        ));
    }

    public function formatReadonly($value, $entry = null)
    {
        return App::getInstance()->theme->partial('_schema/text', array(
            'label'    => $this['label'],
            'name'     => $this['name'],
            'value'    => htmlentities($value),
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

    protected function getPartialTemplate()
    {
        $partialTemplate = '_schema/text';

        if ($this->get('partialTemplate')) {
            $partialTemplate = $this->get('partialTemplate');
        }

        return $partialTemplate;
    }
}
