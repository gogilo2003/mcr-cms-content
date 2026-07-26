<?php

use Mcr\Cms\Content\Enums\ContentStatus;
use Mcr\Cms\Content\Traits\HasPublishingStatus;
use Mcr\Cms\Core\Models\BaseModel;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DummyPost extends BaseModel
{
    use HasPublishingStatus;

    protected $table = 'dummy_posts';
    protected $guarded = [];
}

beforeEach(function () {
    Schema::create('dummy_posts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('status')->default('draft');
        $table->timestamp('published_at')->nullable();
        $table->timestamps();
    });
});

it('correctly reports content status enum labels', function () {
    expect(ContentStatus::Draft->label())->toBe('Draft');
    expect(ContentStatus::Published->label())->toBe('Published');
    expect(ContentStatus::Scheduled->label())->toBe('Scheduled');
});

it('handles publishing state transitions and scopes correctly', function () {
    $post = DummyPost::create([
        'title' => 'Test Article',
        'status' => ContentStatus::Draft,
    ]);

    expect($post->isDraft())->toBeTrue();
    expect($post->isPublished())->toBeFalse();

    $post->publish();

    expect($post->isPublished())->toBeTrue();
    expect($post->status)->toBe(ContentStatus::Published);
    expect($post->published_at)->not->toBeNull();

    $post->unpublish();

    expect($post->isDraft())->toBeTrue();
    expect($post->isPublished())->toBeFalse();
});
