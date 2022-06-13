<?php
namespace App\Core;

use App\Core\Extensions\TwigExtensions;
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

        $this->twigInstance->addExtension(new TwigExtensions($this->twigLoader));

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
