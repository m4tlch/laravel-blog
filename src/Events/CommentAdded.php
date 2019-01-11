<?php

namespace M4tlch\LaravelBlog\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use M4tlch\LaravelBlog\Models\BlogEtcComment;
use M4tlch\LaravelBlog\Models\BlogEtcPost;

/**
 * Class CommentAdded
 * @package M4tlch\LaravelBlog\Events
 */
class CommentAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  BlogEtcPost */
    public $blogEtcPost;
    /** @var  BlogEtcComment */
    public $newComment;

    /**
     * CommentAdded constructor.
     * @param BlogEtcPost $blogEtcPost
     * @param BlogEtcComment $newComment
     */
    public function __construct(BlogEtcPost $blogEtcPost, BlogEtcComment $newComment)
    {
        $this->blogEtcPost=$blogEtcPost;
        $this->newComment=$newComment;
    }

}
