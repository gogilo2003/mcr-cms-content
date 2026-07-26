<?php

declare(strict_types=1);

namespace Mcr\Cms\Content\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasAuthor
{
    /**
     * Boot the trait to auto-assign current user ID on creation.
     */
    public static function bootHasAuthor(): void
    {
        static::creating(function ($model) {
            if (empty($model->author_id) && auth()->check()) {
                $model->author_id = auth()->id();
            }
        });
    }

    /**
     * Get the author model relation.
     */
    public function author(): BelongsTo
    {
        $userModel = config('auth.providers.users.model', 'App\\Models\\User');

        return $this->belongsTo($userModel, 'author_id');
    }
}
