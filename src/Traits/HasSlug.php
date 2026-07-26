<?php

declare(strict_types=1);

namespace Mcr\Cms\Content\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    /**
     * Boot the trait event listener for saving models.
     */
    public static function bootHasSlug(): void
    {
        static::saving(function ($model) {
            $slugSourceColumn = $model->getSlugSourceColumn();
            $slugTargetColumn = $model->getSlugTargetColumn();

            if (empty($model->{$slugTargetColumn}) && !empty($model->{$slugSourceColumn})) {
                $model->{$slugTargetColumn} = $model->generateUniqueSlug($model->{$slugSourceColumn});
            }
        });
    }

    /**
     * Get the source column used to generate the slug.
     */
    public function getSlugSourceColumn(): string
    {
        return property_exists($this, 'slugSource') ? $this->slugSource : 'title';
    }

    /**
     * Get the target column to store the slug.
     */
    public function getSlugTargetColumn(): string
    {
        return property_exists($this, 'slugTarget') ? $this->slugTarget : 'slug';
    }

    /**
     * Generate a unique slug based on source string.
     */
    public function generateUniqueSlug(string $value): string
    {
        $slug = Str::slug($value);
        $originalSlug = $slug;
        $count = 1;
        $slugColumn = $this->getSlugTargetColumn();

        while (static::where($slugColumn, $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }
}
