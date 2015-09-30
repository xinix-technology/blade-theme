<?php namespace Xinix\Theme;

use Bono\App;
use Bono\Theme\Theme;
use Xinix\Blade\BladeView;

/**
 * A Blade Theme for Bono Theme
 *
 * @category  Theme
 * @package   BladeTheme
 * @author    Xinix Technology <hello@xinix.co.id>
 * @copyright 2013 PT Sagara Xinix Solusitama
 * @license   https://raw.github.com/xinix-technology/bono/master/LICENSE MIT
 * @link      https://github.com/xinix-technology/blade-theme
 */
class BladeTheme extends Theme
{
    /**
     * Extension of blade template engine
     *
     * @var string
     */
    protected $extension = '.blade.php';

    /**
     * View instance
     *
     * @var Xinix\Blade\BladeView
     */
    protected $view = null;

    /**
     * View paths cache
     * @var array
     */
    protected $viewPaths;

    /**
     * Reference object to application instance
     * @var Bono\App
     */
    protected $app;

    /**
     * Blade Theme options
     *
     * @var array
     */
    protected $options = array();

    /**
     * Constructor
     *
     * @param array $options Theme options
     */
    public function __construct(array $options = array())
    {
        // prepare default options
        $defaultOptions = array(
            'cachePath' => '../cache',
        );

        $options = array_merge($defaultOptions, $options);

        $this->options = $options;

        // call parent constructor
        parent::__construct($options);

        // set blade-theme module dir as one of base directory
        $directory = explode(DIRECTORY_SEPARATOR.'src', __DIR__);
        $directory = reset($directory);
        $this->addBaseDirectory($directory, 5);

        $this->app = App::getInstance();
    }

    /**
     * Get partial template
     *
     * @param string $template
     * @param array  $data
     *
     * @return string
     */
    public function partial($template, array $data = array())
    {
        $app      = $this->app;
        $template = explode('/', $template);
        $template = implode('.', $template) ?: null;

        $app->view->replace($data);

        return $app->view->make($template, $data)->render();
    }

    /**
     * Resolve template name
     *
     * @param string $template
     *
     * @return string
     */
    public function resolve($template, $view = null)
    {
        return $this->getView()->resolve(str_replace('/', '.', $template));
    }

    /**
     * Get specific view of this theme, I use Blade View Engine
     *
     * @return Xinix\Blade\BladeView
     */
    public function getView()
    {
        if (is_null($this->view)) {
            $appPath = $this->app->config('app.path');

            if (! is_null($appPath)) {
                $this->options['cachePath'] = $appPath.DIRECTORY_SEPARATOR.$this->options['cachePath'];
            }

            if (! is_dir($this->options['cachePath'])) {
                mkdir($this->options['cachePath'], 0755, true);
            }

            $this->options['viewPaths'] = $this->arrayFlatten($this->baseDirectories);

            $this->view = new BladeView($this->options);
        }

        return $this->view;
    }

    /**
     * A helper to flatten array
     *
     * @param array $array The array you want to flattened
     *
     * @return array The flattened array
     */
    protected function arrayFlatten($array)
    {
        $flattenedArray = array();

        array_walk_recursive($array, function ($x) use (&$flattenedArray) {
            $flattenedArray[] = $x;
        });

        return $flattenedArray;
    }
}
