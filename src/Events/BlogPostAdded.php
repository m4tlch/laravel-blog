<?php

namespace M4tlch\LaravelBlog\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use M4tlch\LaravelBlog\Models\M4BlogPost;

/**
 * Class BlogPostAdded
 * @package M4tlch\LaravelBlog\Events
 */
class BlogPostAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  M4BlogPost */
    public $blogEtcPost;

    /**
     * BlogPostAdded constructor.
     * @param M4BlogPost $blogEtcPost
     */
    public function __construct(M4BlogPost $blogEtcPost)
    {
        $this->blogEtcPost=$blogEtcPost;
    }

}
