<?php

namespace M4tlch\LaravelBlog\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use M4tlch\LaravelBlog\Models\M4BlogComment;
use M4tlch\LaravelBlog\Models\M4BlogPost;

/**
 * Class CommentAdded
 * @package M4tlch\LaravelBlog\Events
 */
class CommentAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  M4BlogPost */
    public $m4BlogPost;
    /** @var  M4BlogComment */
    public $newComment;

    /**
     * CommentAdded constructor.
     * @param M4BlogPost $m4BlogPost
     * @param M4BlogComment $newComment
     */
    public function __construct(M4BlogPost $m4BlogPost, M4BlogComment $newComment)
    {
        $this->m4BlogPost=$m4BlogPost;
        $this->newComment=$newComment;
    }

}
