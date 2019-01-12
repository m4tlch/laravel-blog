<?php

namespace M4tlch\LaravelBlog\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use M4tlch\LaravelBlog\Models\M4BlogPost;

/**
 * Class UploadedImage
 * @package M4tlch\LaravelBlog\Events
 */
class UploadedImage
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  M4BlogPost|null */
    public $m4BlogPost;
    /**
     * @var
     */
    public $image;

    public $source;
    public $image_filename;

    /**
     * UploadedImage constructor.
     *
     * @param $image_filename - the new filename
     * @param M4BlogPost $m4BlogPost
     * @param $image
     * @param $source string|null  the __METHOD__  firing this event (or other string)
     */
    public function __construct(string $image_filename, $image,M4BlogPost $m4BlogPost=null,string $source='other')
    {
        $this->image_filename = $image_filename;
        $this->m4BlogPost=$m4BlogPost;
        $this->image=$image;
        $this->source=$source;
    }

}
