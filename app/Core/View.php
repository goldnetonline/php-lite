<?php
/*
 * File: View.php
 * Project: Core
 * File Created: Sunday, 23rd May 2021 9:47:39 pm
 * Author: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Last Modified: Monday, 28th February 2022 1:04:40 pm
 * Modified By: Temitayo Bodunrin (temitayo@camelcase.co)
 * -----
 * Copyright 2022, CamelCase Technologies Ltd
 */

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    use \App\Core\Traits\Singleton;

    public $app;
    public $cacheRoot;
    private $twigLoader;
    private $twigInstance;
    private $viewDirRoot;

    public function __construct($app)
    {
        $this->app = $app;
        $this->cacheRoot = BASE_DIR . "/.cache/view";
    }

    public function configure()
    {
        $this->viewDirRoot = str_replace("/", DIRECTORY_SEPARATOR, $this->app->getConfig('view.view_dir'));
        $this->twigLoader = new FilesystemLoader($this->viewDirRoot);
        $this->twigInstance = new Environment($this->twigLoader, [
            'cache' => $this->cacheRoot,
            'auto_reload' => true,
        ]);

    }

    public function findFile(string $file): ?string
    {
        $pageFile = null;
        if (\file_exists($file)) {
            $pageFile = $file;
        } elseif (\file_exists($file . ".html")) {
            $pageFile = $file . ".html";
        } elseif (\file_exists($file . ".htm")) {
            $pageFile = $file . ".htm";
        } elseif (\file_exists($file . ".php")) {
            $pageFile = $file . ".php";
        }

        return $pageFile;

    }

    public function make(string $path, array $context = [])
    {
        $context = array_merge($this->app->globalContext, $context);
        // Remove absolte path
        return $this->twigInstance->render(str_replace($this->viewDirRoot, '', $path), $context);
    }
}
