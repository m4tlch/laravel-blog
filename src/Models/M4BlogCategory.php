<?php

namespace M4tlch\LaravelBlog\Models;

use Illuminate\Database\Eloquent\Model;

class M4BlogCategory extends Model
{
    public $fillable = [
        'category_name',
        'slug',
        'category_description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(M4BlogPost::class, 'blog_etc_post_categories');
    }

    /**
     * Returns the public facing URL of showing blog posts in this category
     * @return string
     */
    public function url()
    {
        return route("m4blog.view_category", $this->slug);
    }

    /**
     * Returns the URL for an admin user to edit this category
     * @return string
     */
    public function edit_url()
    {
        return route("m4blog.admin.categories.edit_category", $this->id);
    }

//    public function scopeApproved($query)
//    {
//        dd("A");
//        return $query->where("approved", true);
//    }
}
