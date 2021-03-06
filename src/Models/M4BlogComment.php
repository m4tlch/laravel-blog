<?php

namespace M4tlch\LaravelBlog\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use M4tlch\LaravelBlog\Scopes\BlogCommentApprovedAndDefaultOrderScope;

class M4BlogComment extends Model
{
    public $casts = [
        'approved' => 'boolean',
    ];

    public $fillable = [

        'comment',
        'author_name',
    ];


    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        /* If user is logged in and \Auth::user()->canManageM4BlogPosts() == true, show any/all posts.
           otherwise (which will be for most users) it should only show published posts that have a posted_at
           time <= Carbon::now(). This sets it up: */
        static::addGlobalScope(new BlogCommentApprovedAndDefaultOrderScope());
    }



    /**
     * The associated M4BlogPost
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(M4BlogPost::class,"m4_blog_post_id");
    }

    /**
     * Comment author user (if set)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return author string (either from the User (via ->user_id), or the submitted author_name value
     *
     * @return string
     */
    public function author()
    {
        if ($this->user_id) {
            $field = config("m4blog.comments.user_field_for_author_name","name");
            return optional($this->user)->$field;
        }

        return $this->author_name;
    }
}
