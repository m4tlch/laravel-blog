<?php

namespace M4tlch\LaravelBlog\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use M4tlch\LaravelBlog\Models\M4BlogPost;

/**
 * Class BlogPostWillBeDeleted
 * @package M4tlch\LaravelBlog\Events
 */
class BlogPostWillBeDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  M4BlogPost */
    public $m4BlogPost;

    /**
     * BlogPostWillBeDeleted constructor.
     * @param M4BlogPost $m4BlogPost
     */
    public function __construct(M4BlogPost $m4BlogPost)
    {
        $this->m4BlogPost=$m4BlogPost;
    }

}
