<?php

declare(strict_types=1);

namespace Mcr\Cms\Content\Traits;

trait HasSeo
{
    /**
     * Boot trait to add array casts for meta fields.
     */
    public function initializeHasSeo(): void
    {
        $this->casts['seo_meta'] = 'array';
    }

    /**
     * Get SEO title fallback to model title.
     */
    public function getSeoTitle(): string
    {
        return $this->seo_meta['title'] ?? $this->title ?? '';
    }

    /**
     * Get SEO description.
     */
    public function getSeoDescription(): ?string
    {
        return $this->seo_meta['description'] ?? $this->excerpt ?? null;
    }
}
