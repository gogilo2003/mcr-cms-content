<?php

declare(strict_types=1);

namespace Mcr\Cms\Content\Traits;

trait HasMeta
{
    /**
     * Boot trait to cast meta attribute to array.
     */
    public function initializeHasMeta(): void
    {
        $this->casts['meta'] = 'array';
    }

    /**
     * Get a metadata value.
     */
    public function getMeta(string $key, mixed $default = null): mixed
    {
        return $this->meta[$key] ?? $default;
    }

    /**
     * Set a metadata value.
     */
    public function setMeta(string $key, mixed $value): self
    {
        $meta = $this->meta ?? [];
        $meta[$key] = $value;
        $this->meta = $meta;

        return $this;
    }
}
