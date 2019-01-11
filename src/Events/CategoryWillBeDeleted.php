<?php

namespace M4tlch\LaravelBlog\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use M4tlch\LaravelBlog\Models\M4BlogCategory;

/**
 * Class CategoryWillBeDeleted
 * @package M4tlch\LaravelBlog\Events
 */
class CategoryWillBeDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  M4BlogCategory */
    public $blogEtcCategory;

    /**
     * CategoryWillBeDeleted constructor.
     * @param M4BlogCategory $blogEtcCategory
     */
    public function __construct(M4BlogCategory $blogEtcCategory)
    {
        $this->blogEtcCategory=$blogEtcCategory;
    }

}
