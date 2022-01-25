<?php
/*
 * File: App.php
 * Project: Core
 * File Created: Sunday, 23rd May 2021 7:03:50 pm
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Tuesday, 25th January 2022 11:12:30 am
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2022, CamelCase Technologies Ltd
 */

namespace App\Core;

use App\Core\Traits\Singleton;

class App
{

    use Singleton;

    public $request;
    public $response;
    public $view;
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

        return $_ENV[$key] ?? $default;
    }

    /**
     * Get the directory to the static page
     */
    public function getStaticPageDir(): string
    {
        if (!$this->pageDir) {
            $this->pageDir = preg_replace("/\/$/", '', $this->getConfig('view_dir'));
        }

        return $this->pageDir;
    }

    /**
     * Get the static page for the home page
     */
    public function getHomeStaticPage(): string
    {
        return $this->getConfig('homepage');
    }

    /**
     * Get all dynamic routes
     */
    public function getRoutes(): array
    {
        if ($this->routes) {
            return $this->routes;
        }

        $routeFile = $this->getConfig('route_file');

        if ($routeFile && \file_exists($routeFile)) {
            $this->routes = include_once $routeFile;
        } else {
            $this->routes = [];
        }

        return $this->routes;
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

        $staticPath = $this->getStaticPageDir() . "/" . $page;
        $pageFile = $this->view->findFile($this->getStaticPageDir() . "/" . $page);

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
        if (!$this->getConfig('maintenance_mode')) {
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

        if ($this->request->slug === '/') {

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

                    if (!$this->getConfig('debug')) {
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

        $this->getRoutes();

        if (!sizeOf($this->routes)) {
            return $this;
        }

        // Keep it simple
        if (!isset($this->routes[$this->request->uri])) {
            return $this;
        }

        $route = $this->routes[$this->request->uri];
        $doRoute = null;
        if ($route instanceof \Closure) {
            $doRoute = $route($this->request, $this->response);
        } elseif (is_array($route)) {
            if (isset($route[0]) && \class_exists($route[0])) {
                $controller = new $route[0]($this);
                // If this is not set, then __invoke on the controller will be called
                if (
                    isset($route[1])
                    && !empty($route[1])
                    && is_string($route[1])
                ) {
                    if (!\method_exists($controller, $route[1])) {
                        return $this->abort();
                    }
                    $doRoute = $controller->{$route[1]}();

                } else {
                    // This man must be using invoker
                    $doRoute = $controller;
                }
            } else {

                $doRoute = $this->response->json($route);
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
            $html = \file_get_contents($errorPage);
        }

        $this->response->html($html, $code)->send();
    }

    public function run()
    {
        // Set debug after app is initialized
        $this->debug = $this->getConfig('debug');
        $this->globalContext = $this->getConfig('global_context');

        // Configure view renderer
        $this->view->configure();

        $this->maintenanceMode()->loadPageManager()->loadRouters();

        if (!$this->response->responseText) {
            return $this->abort();
        }

        return $this->response->send();
    }

}
