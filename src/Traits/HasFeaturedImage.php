<?php

declare(strict_types=1);

namespace Mcr\Cms\Content\Traits;

trait HasFeaturedImage
{
    /**
     * Get the featured image URL.
     */
    public function getFeaturedImageUrl(?string $fallback = null): ?string
    {
        if (!empty($this->featured_image)) {
            return asset('storage/' . $this->featured_image);
        }

        return $fallback;
    }
}
