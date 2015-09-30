<?php namespace Xinix\Theme\Middleware;

use Bono\App;
use Bono\Middleware\NotificationMiddleware as Middleware;

class NotificationMiddleware extends Middleware
{
    public function show($options = null)
    {
        unset($_SESSION['notification']);

        if (is_null($options)) {
            return $this->show(array('level' => 'error')) . "\n" . $this->show(array('level' => 'info'));
        }

        $messages = $this->query($options);

        if (! empty($messages)) {
            return App::getInstance()->theme->partial('components/alert', array(
                'options' => $options,
                'messages' => $messages,
            ));
        }
    }
}
