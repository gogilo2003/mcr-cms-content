<?php

declare(strict_types=1);

namespace Mcr\Cms\Content\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContentPublished
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly Model $model
    ) {}
}
