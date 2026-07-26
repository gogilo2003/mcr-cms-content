# MCR CMS Content Publishing Engine (`mcr/cms-content`)

[![Tests](https://img.shields.io/badge/pest-passing-brightgreen.svg)](https://pestphp.com)
[![Laravel](https://img.shields.io/badge/laravel-12.x%20%7C%2013.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/php-8.3%2B-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

`mcr/cms-content` is the publishing engine for the Modular CMS ecosystem. It provides lifecycle status enums, reusable Eloquent traits, and content events.

---

## Installation

Install via Composer into any Laravel 12 or 13 application:

```bash
composer require mcr/cms-content
```

Transitively requires `mcr/cms-core`. Laravel auto-discovers `ContentServiceProvider` automatically.

---

## Features & Model Traits

### 1. Publishing Status (`ContentStatus` & `HasPublishingStatus`)
Supports lifecycle states: `Draft`, `Published`, `Scheduled`, `Archived`, and `Private`.

```php
use Mcr\Cms\Content\Enums\ContentStatus;
use Mcr\Cms\Content\Traits\HasPublishingStatus;
use Mcr\Cms\Core\Models\BaseModel;

class Article extends BaseModel
{
    use HasPublishingStatus;
}

// Scopes
$publishedArticles = Article::published()->get();
$scheduledArticles = Article::scheduled()->get();
```

### 2. Automatic Slug Generation (`HasSlug`)
Generates unique, URL-safe slugs automatically on model saving.

```php
use Mcr\Cms\Content\Traits\HasSlug;

class Article extends BaseModel
{
    use HasSlug; // Slug automatically generated from 'title' column
}
```

### 3. SEO Metadata (`HasSeo`)
Casts `seo_meta` column into typed SEO metadata arrays.

```php
use Mcr\Cms\Content\Traits\HasSeo;

class Article extends BaseModel
{
    use HasSeo;
}
```

### 4. Author Association (`HasAuthor`)
Automatically binds current authenticated user ID on record creation.

```php
use Mcr\Cms\Content\Traits\HasAuthor;

class Article extends BaseModel
{
    use HasAuthor;
}
```

### 5. Featured Images & Metadata (`HasFeaturedImage` & `HasMeta`)
Provides storage URL accessors for featured media and flexible JSON metadata attributes.

```php
use Mcr\Cms\Content\Traits\HasFeaturedImage;
use Mcr\Cms\Content\Traits\HasMeta;

class Article extends BaseModel
{
    use HasFeaturedImage, HasMeta;
}
```

---

## Content Events

- `ContentPublished`: Dispatched whenever content transitions into published state.

---

## Testing

Run Pest test suite:

```bash
vendor/bin/pest
```

---

## License

Open-sourced software licensed under the [MIT license](LICENSE).
