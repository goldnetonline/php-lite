<?php
namespace App\Core;

use App\Core\Traits\Singleton;

class App
{

    use Singleton;

    public $request;
    public $response;
    public $view;
    public $routeManager;
    public $baseDir;
    public $pageDir;
    public $isPageFile = false;
    private $routes;
    public $globalContext;
    public $debug;

    public function __construct()
    {
        $this->baseDir = BASE_DIR;
        $this->request = Request::getInstance($this);
        $this->response = Response::getInstance($this);
        $this->view = View::getInstance($this);

    }

    /**
     * Read from config file
     * @param string $conf       The input key to get
     * @param string $default   The default value
     */

    public function getConfig($conf = null, $default = null)
    {
        $allConfig = require dirname(__FILE__) . '/../config.php';

        if (!$conf) {
            return $allConfig;
        }

        $splitConfig = explode(".", $conf);

        if (sizeOf($splitConfig) === 1) {
            return $allConfig[$conf] ?? $default;
        } else {
            if (isset($allConfig[$splitConfig[0]]) && is_array($allConfig[$splitConfig[0]])) {
                return $allConfig[$splitConfig[0]][$splitConfig[1]];
            }
            return $default;
        }

    }

    /**
     * Read from env variable
     * @param string $key       The input key to get
     * @param string $default   The default value
     */

    public function env($key = null, $default = null)
    {
        if (!$key) {
            return $_ENV;
        }

        $env = $_ENV[$key] ?? $default;
        if (in_array($env, ['true', 'false'])) {
            if ($env === 'true') {
                $env = true;
            } else {
                $env = false;
            }

        }
        return $env;

    }

    /**
     * Get the directory to the static page
     */
    public function getStaticPageDir(): string
    {
        if (!$this->pageDir) {
            $this->pageDir = preg_replace("/\/$/", '', $this->getConfig('view.view_dir', 'views'));
            $this->pageDir .= DIRECTORY_SEPARATOR;
            $this->pageDir .= preg_replace("/\/$/", '', $this->getConfig('view.pages_dir', DIRECTORY_SEPARATOR));
        }

        return $this->pageDir;
    }

    /**
     * Get the static page for the home page
     */
    public function getHomeStaticPage(): ?string
    {
        return $this->getConfig('view.homepage', null);
    }

    /**
     * Get the direct path to a static page
     *
     * @param $page
     *
     * @return mixed
     */
    public function getStaticPage(string $page, bool $lookInward = false): ?string
    {

        $staticPath = $this->getStaticPageDir() . DIRECTORY_SEPARATOR . $page;
        $pageFile = $this->view->findFile($staticPath);

        if (!$pageFile && $lookInward) {
            $pageFile = $this->view->findFile(dirname(__FILE__) . "/../views/" . $page);
        }

        return $pageFile;
    }

    /**
     * Check if app is on maintenance mode and show maintenance page
     */
    private function maintenanceMode()
    {
        if (!$this->getConfig('app.maintenance_mode')) {
            return $this;
        }

        return $this->abort(503, 'maintenance');
    }

    /**
     * Load page request
     */
    private function loadPageManager(): Self
    {
        $staticPath = null;

        if ($this->request->slug === '-') {
            $homePage = $this->getHomeStaticPage();

            if ($homePage) {
                $staticPath = $homePage;
            }

        } else {
            $staticPath = $this->request->slug;
        }

        if ($staticPath) {

            $pageFile = $this->getStaticPage($staticPath);

            if ($pageFile) {

                try {
                    $this->response->html($this->view->make($pageFile));
                    $this->isPageFile = true;
                } catch (\Throwable $th) {

                    // @todo
                    // Log the error

                    if (!$this->getConfig('app.debug')) {
                        //I dont care, throw 500 Error
                        return $this->abort(500);
                    }

                    throw $th;

                }
            }

        }

        return $this;

    }

    /**
     * Load controller routes
     */
    private function loadRouters()
    {

        // Something ready to be shipped already
        if ($this->response->responseText) {
            return $this;
        }

        $routeHandler = $this->routeManager->getRouteHandler($this->request);

        if (!$routeHandler) {
            return $this;
        }

        return $this->processRouteHandler($routeHandler);

    }

    /**
     * Process a route handler
     *
     * @param mixed $handler    The route handler can be anything from sring, array or closure
     * @return mixed            Response string
     */
    private function processRouteHandler($handler)
    {
        $doRoute = null;
        if ($handler instanceof \Closure) {
            $doRoute = $handler($this->request, $this->response);
        } elseif (is_array($handler)) {
            if (isset($handler[0]) && \class_exists($handler[0])) {
                $controller = new $handler[0]($this);
                // If this is not set, then __invoke on the controller will be called
                if (
                    isset($handler[1])
                    && !empty($handler[1])
                    && is_string($handler[1])
                ) {
                    if (!\method_exists($controller, $handler[1])) {
                        return $this->abort();
                    }
                    $doRoute = $controller->{$handler[1]}();

                } else {
                    // This man must be using invoker
                    $doRoute = $controller;
                }
            } else {
                $doRoute = $this->response->json($handler);
            }
        }

        // if direct response is sent
        if (!$doRoute instanceof Response && $doRoute) {
            // Not sure of the response type just assume
            return $this->response->make($doRoute);
        }

    }

    /**
     * Throw a throedly error page
     */
    private function abort($code = 404, string $view = null)
    {

        $errorPage = strval($code);
        if ($view) {
            $errorPage = $view;
        } else {
            if (\preg_match("/^50/", strval($code))) {
                $errorPage = 'error';
            }
        }

        $errorPage = $this->getStaticPage($errorPage, true);

        $html = "<h1>$code Error</h1>";
        if ($errorPage) {
            try {
                $html = $this->view->make($errorPage);
            } catch (\Throwable $th) {
                $html = \file_get_contents($errorPage);
            }
        }

        $this->response->html($html, $code)->send();
    }

    public function run()
    {
        // Set debug after app is initialized
        $this->debug = $this->getConfig('app.debug');

        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);

        if (!$this->debug) {
            $whoops->allowQuit(false);
            $whoops->writeToOutput(false);
        }

        try {
            // Load the route managers
            $this->routeManager = RouteManager::getInstance($this);
            $this->globalContext = $this->getConfig('view.global_context');

            // Configure view renderer
            $this->view->configure();

            $this->maintenanceMode()->loadPageManager()->loadRouters();

            if (!$this->response->responseText) {
                return $this->abort();
            }

            return $this->response->send();

        } catch (\Throwable $th) {
            if (!$this->debug) {
                $this->abort(500);
            } else {
                $this->response->html($whoops->handleException($th), 500)->send();
            }

        }

    }

}
