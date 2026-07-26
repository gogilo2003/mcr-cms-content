<?php

declare(strict_types=1);

namespace Mcr\Cms\Content\Providers;

use Illuminate\Support\ServiceProvider;
use Mcr\Cms\Content\ContentFeature;
use Mcr\Cms\Core\Contracts\CmsContext;

class ContentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Auto-register Feature with CmsContext if available
        $this->app->resolving(CmsContext::class, function (CmsContext $context) {
            (new ContentFeature())->register($context);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->bound(CmsContext::class)) {
            (new ContentFeature())->boot($this->app->make(CmsContext::class));
        }
    }
}
