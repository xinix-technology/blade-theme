<?php namespace Xinix\Theme\Components;

use Bono\App;
use Bono\Helper\URL;
use Norm\Cursor;

class Pagination
{
    /**
     * Static instance, you can create class via static method
     *
     * @var Xinix\Theme\Components\Pagination
     */
    protected static $instances = null;

    /**
     * Application context
     *
     * @var Bono\App
     */
    protected $app              = null;

    /**
     * Current page
     *
     * @var int
     */
    protected $current          = null;

    /**
     * Entries
     * @var Norm\Cursor
     */
    protected $entries          = null;

    /**
     * Limit of each collection that shown in a page
     *
     * @var int
     */
    protected $limit            = null;

    /**
     * Link contain paging data
     *
     * @var array
     */
    protected $links            = array();

    /**
     * Partial template that we use for paging
     *
     * @var string
     */
    protected $partialTemplate  = 'components/paginator';

    /**
     * Base URL that we use for paging
     *
     * @var string
     */
    protected $baseUrl = '';

    /**
     * Constructor
     *
     * @param Norm\Cursor $entries Entries that we want to page
     */
    public function __construct(Cursor $entries)
    {
        $this->entries = $entries;
        $this->app     = App::getInstance();

        $configCollection = $this->app->config('norm.collections');

        if (isset($configCollection['default'])) {
            if (isset($configCollection['default']['limit'])) {
                $this->limit = $configCollection['default']['limit'];
            }
        }

        $this->baseUrl = URL::current();
    }

    /**
     * Create new instance of Xinix\Theme\Components\Pagination via static method
     *
     * @param Norm\Cursor $entries Entries that we want to page
     *
     * @return Xinix\Theme\Components\Pagination New instance of Pagination class
     */
    public static function create(Cursor $entries)
    {
        $Class = get_called_class();

        if (is_null(static::$instances[$Class])) {
            static::$instances = new $Class($entries);
        }

        return static::$instances;
    }

    /**
     * Set out base URL
     *
     * @param [type] $url [description]
     */
    public function setBaseUrl($url)
    {
        $this->baseUrl = $url;

        return $this;
    }

    /**
     * Paginate the entries into snipped collection
     *
     * @return string The HTML String that appended to our template
     */
    public function paginate()
    {
        $limit = $this->limit;

        if (is_null($limit)) {
            return;
        }

        $all     = $this->entries->count();
        $average = ceil($all / $limit);

        if ($average == 1) {
            return;
        }

        $skip    = $this->app->request->get('!skip');

        for ($i = 0; $i < $average; $i++) {
            $isCurrent       = ($skip == ($i*$limit));
            $this->links[$i] = array(
                'uri'        => '?!skip='.($i*$limit),
                'isCurrent'  => $isCurrent,
            );

            if ($isCurrent) {
                $this->current = $i;
            }
        }

        return $this->app->theme->partial($this->partialTemplate, array(
            'links'   => $this->links,
            'baseUrl' => $this->baseUrl,
            'current' => $this->current,
            'app'     => $this->app,
        ));
    }

    /**
     * Set partial template
     *
     * @param string $partial Partial template that we want to use for paging
     *
     * @return Xinix\Theme\Components\Pagination Return instances of Pagination for chaining access
     */
    public function setPartialTemplate($partial)
    {
        $this->partialTemplate = $partial;

        return $this;
    }
}
