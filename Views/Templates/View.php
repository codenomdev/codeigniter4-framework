<?php

namespace Codenom\Framework\Views\Templates;

use CodeIgniter\View\Exceptions\ViewException;
use Codenom\Framework\Config\Services;
use Psr\Log\LoggerInterface;


class View extends \CodeIgniter\View\View
{
    /**
     * Constructor
     *
     * @param \Config\View                             $config
     * @param string|null                              $viewPath
     * @param \CodeIgniter\Autoloader\FileLocator|null $loader
     * @param boolean|null                             $debug
     * @param \Psr\Log\LoggerInterface                 $logger
     */
    public function __construct($config, string $viewPath = null, $loader = null, bool $debug = null, LoggerInterface $logger = null)
    {
        $this->config   = $config;
        $this->viewPath = rtrim($viewPath, '\\/ ') . DIRECTORY_SEPARATOR;
        $this->loader   = $loader ?? Services::locator();
        $this->logger   = $logger ?? Services::logger();
        $this->debug    = $debug ?? CI_DEBUG;
        $this->saveData = $config->saveData ?? null;
    }

    //--------------------------------------------------------------------

    /**
     * Builds the output based upon a file name and any
     * data that has already been set.
     *
     * Valid $options:
     *     - cache 		number of seconds to cache for
     *  - cache_name	Name to use for cache
     *
     * @param string  $view
     * @param array   $options
     * @param boolean $saveData
     *
     * @return string
     */
    public function render(string $view, array $options = null, bool $saveData = null): string
    {
        $this->renderVars['start'] = microtime(true);

        // Store the results here so even if
        // multiple views are called in a view, it won't
        // clean it unless we mean it to.
        $saveData                    = $saveData ?? $this->saveData;
        $fileExt                     = pathinfo($view, PATHINFO_EXTENSION);
        $realPath                    = empty($fileExt) ? $view . '.phtml' : $view; // allow Views as .html, .tpl, etc (from CI3)
        $this->renderVars['view']    = $realPath;
        $this->renderVars['options'] = $options;

        // Was it cached?
        if (isset($this->renderVars['options']['cache'])) {
            $this->renderVars['cacheName'] = $this->renderVars['options']['cache_name'] ?? str_replace('.php', '', $this->renderVars['view']);

            if ($output = cache($this->renderVars['cacheName'])) {
                $this->logPerformance($this->renderVars['start'], microtime(true), $this->renderVars['view']);
                return $output;
            }
        }

        $this->renderVars['file'] = $this->viewPath . $this->renderVars['view'];

        if (!is_file($this->renderVars['file'])) {
            $this->renderVars['file'] = $this->loader->locateFile($this->renderVars['view'], 'Views', empty($fileExt) ? 'phtml' : $fileExt);
        }

        // locateFile will return an empty string if the file cannot be found.
        if (empty($this->renderVars['file'])) {
            throw ViewException::forInvalidFile($this->renderVars['view']);
        }

        // Make our view data available to the view.
        $this->tempData = $this->tempData ?? $this->data;
        extract($this->tempData);

        if ($saveData) {
            $this->data = $this->tempData;
        }

        // Save current vars
        $renderVars = $this->renderVars;

        ob_start();
        include $this->renderVars['file']; // PHP will be processed
        $output = ob_get_contents();
        @ob_end_clean();

        // Get back current vars
        $this->renderVars = $renderVars;

        // When using layouts, the data has already been stored
        // in $this->sections, and no other valid output
        // is allowed in $output so we'll overwrite it.
        if (!is_null($this->layout) && empty($this->currentSection)) {
            $layoutView   = $this->layout;
            $this->layout = null;
            // Save current vars
            $renderVars = $this->renderVars;
            $output     = $this->render($layoutView, $options, $saveData);
            // Get back current vars
            $this->renderVars = $renderVars;
        }

        $this->logPerformance($this->renderVars['start'], microtime(true), $this->renderVars['view']);

        if (($this->debug && (!isset($options['debug']) || $options['debug'] === true)) && in_array('CodeIgniter\Filters\DebugToolbar', service('filters')->getFiltersClass()['after'], true)) {
            $toolbarCollectors = config(\Config\Toolbar::class)->collectors;

            if (in_array(\CodeIgniter\Debug\Toolbar\Collectors\Views::class, $toolbarCollectors, true)) {
                // Clean up our path names to make them a little cleaner
                $this->renderVars['file'] = clean_path($this->renderVars['file']);
                $this->renderVars['file'] = ++$this->viewsCount . ' ' . $this->renderVars['file'];
                $output                   = '<!-- DEBUG-VIEW START ' . $this->renderVars['file'] . ' -->' . PHP_EOL
                    . $output . PHP_EOL
                    . '<!-- DEBUG-VIEW ENDED ' . $this->renderVars['file'] . ' -->' . PHP_EOL;
            }
        }

        // Should we cache?
        if (isset($this->renderVars['options']['cache'])) {
            cache()->save($this->renderVars['cacheName'], $output, (int) $this->renderVars['options']['cache']);
        }

        $this->tempData = null;

        return $output;
    }
}
