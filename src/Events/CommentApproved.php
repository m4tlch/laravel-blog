<?php

namespace M4tlch\LaravelBlog\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use M4tlch\LaravelBlog\Models\M4BlogComment;

/**
 * Class CommentApproved
 * @package M4tlch\LaravelBlog\Events
 */
class CommentApproved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  M4BlogComment */
    public $comment;

    /**
     * CommentApproved constructor.
     * @param M4BlogComment $comment
     */
    public function __construct(M4BlogComment $comment)
    {
        $this->comment=$comment;
        // you can get the blog post via $comment->post
    }

}
