<?php

declare(strict_types=1);

namespace Mcr\Cms\Content;

use Mcr\Cms\Core\Contracts\CmsContext;
use Mcr\Cms\Core\Features\Feature;

class ContentFeature extends Feature
{
    /**
     * Register Content package features with the CMS.
     */
    public function register(CmsContext $context): void
    {
        $context->permissions()->register([
            'manage-content',
            'publish-content',
        ]);
    }

    /**
     * Boot Content package resources.
     */
    public function boot(CmsContext $context): void
    {
        // Boot content routines
    }
}
