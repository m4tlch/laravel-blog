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
    public $m4BlogCategory;

    /**
     * CategoryWillBeDeleted constructor.
     * @param M4BlogCategory $m4BlogCategory
     */
    public function __construct(M4BlogCategory $m4BlogCategory)
    {
        $this->m4BlogCategory=$m4BlogCategory;
    }

}
