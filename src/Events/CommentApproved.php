<?php

namespace M4tlch\LaravelBlog\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use M4tlch\LaravelBlog\Models\BlogEtcComment;

/**
 * Class CommentApproved
 * @package M4tlch\LaravelBlog\Events
 */
class CommentApproved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  BlogEtcComment */
    public $comment;

    /**
     * CommentApproved constructor.
     * @param BlogEtcComment $comment
     */
    public function __construct(BlogEtcComment $comment)
    {
        $this->comment=$comment;
        // you can get the blog post via $comment->post
    }

}
