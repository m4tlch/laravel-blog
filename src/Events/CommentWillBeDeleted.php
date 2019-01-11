<?php

namespace M4tlch\LaravelBlog\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use M4tlch\LaravelBlog\Models\M4BlogComment;

/**
 * Class CommentWillBeDeleted
 * @package M4tlch\LaravelBlog\Events
 */
class CommentWillBeDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  M4BlogComment */
    public $comment;

    /**
     * CommentWillBeDeleted constructor.
     * @param M4BlogComment $comment
     */
    public function __construct(M4BlogComment $comment)
    {
        $this->comment=$comment;
    }

}
