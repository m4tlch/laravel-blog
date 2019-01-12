<?php

namespace M4tlch\LaravelBlog\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use M4tlch\LaravelBlog\Models\M4BlogCategory;

/**
 * Class CategoryEdited
 * @package M4tlch\LaravelBlog\Events
 */
class CategoryEdited
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  M4BlogCategory */
    public $m4BlogCategory;

    /**
     * CategoryEdited constructor.
     * @param M4BlogCategory $m4BlogCategory
     */
    public function __construct(M4BlogCategory $m4BlogCategory)
    {
        $this->m4BlogCategory=$m4BlogCategory;
    }

}
