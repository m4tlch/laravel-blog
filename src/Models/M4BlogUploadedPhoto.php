<?php

namespace M4tlch\LaravelBlog\Models;

use Illuminate\Database\Eloquent\Model;

class M4BlogUploadedPhoto extends Model
{
    public $table = 'm4_blog_uploaded_photos';
    public $casts = [
        'uploaded_images' => 'array',
    ];
    public $fillable = [

        'image_title',
        'uploader_id',
        'source', 'uploaded_images',
    ];
}
