<?php

declare(strict_types=1);

namespace Mcr\Cms\Content\Traits;

use Illuminate\Database\Eloquent\Builder;
use Mcr\Cms\Content\Enums\ContentStatus;

trait HasPublishingStatus
{
    /**
     * Boot the trait and initialize casts.
     */
    public function initializeHasPublishingStatus(): void
    {
        $this->casts['status'] = ContentStatus::class;
        $this->casts['published_at'] = 'datetime';
    }

    /**
     * Scope query to published models.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', ContentStatus::Published)
            ->where(function (Builder $q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            });
    }

    /**
     * Scope query to draft models.
     */
    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', ContentStatus::Draft);
    }

    /**
     * Scope query to scheduled models.
     */
    public function scopeScheduled(Builder $query): Builder
    {
        return $query->where('status', ContentStatus::Scheduled);
    }

    /**
     * Check if the content is published.
     */
    public function isPublished(): bool
    {
        if ($this->status !== ContentStatus::Published) {
            return false;
        }

        return $this->published_at === null || $this->published_at->isPast();
    }

    /**
     * Check if the content is a draft.
     */
    public function isDraft(): bool
    {
        return $this->status === ContentStatus::Draft;
    }

    /**
     * Mark model as published.
     */
    public function publish(): bool
    {
        $this->status = ContentStatus::Published;
        $this->published_at = $this->published_at ?? now();

        return $this->save();
    }

    /**
     * Mark model as draft.
     */
    public function unpublish(): bool
    {
        $this->status = ContentStatus::Draft;

        return $this->save();
    }
}
