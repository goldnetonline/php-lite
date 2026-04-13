<?php

declare (strict_types = 1);

use PHPUnit\Framework\TestCase;

final class StarterConfigTest extends TestCase
{
    public function testStarterConfigContainsExpectedKeys(): void
    {
        if (!defined('BASE_DIR')) {
            define('BASE_DIR', dirname(__DIR__, 2));
        }

        require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

        $config = require_once dirname(__DIR__, 2) . '/app/config.php';

        self::assertArrayHasKey('app', $config);
        self::assertArrayHasKey('view', $config);
        self::assertArrayHasKey('mail', $config);
        self::assertArrayHasKey('cache_dir', $config['view']);
    }

    public function testStarterViewDirectoriesExist(): void
    {
        $baseDir = dirname(__DIR__, 2);

        self::assertDirectoryExists($baseDir . '/views');
        self::assertDirectoryExists($baseDir . '/views/pages');
    }

    public function testEnvExampleExistsForNewProjects(): void
    {
        self::assertFileExists(dirname(__DIR__, 2) . '/.env.example');
    }
}
