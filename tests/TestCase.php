<?php

declare(strict_types=1);

namespace Mcr\Cms\Content\Tests;

use Mcr\Cms\Content\Providers\ContentServiceProvider;
use Mcr\Cms\Core\Providers\CoreServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    /**
     * Load package providers.
     */
    protected function getPackageProviders($app): array
    {
        return [
            CoreServiceProvider::class,
            ContentServiceProvider::class,
        ];
    }
}
