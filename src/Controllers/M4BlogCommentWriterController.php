<?php

namespace M4tlch\LaravelBlog\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use M4tlch\LaravelBlog\Captcha\CaptchaAbstract;
use M4tlch\LaravelBlog\Captcha\UsesCaptcha;
use M4tlch\LaravelBlog\Events\CommentAdded;
use M4tlch\LaravelBlog\Models\M4BlogComment;
use M4tlch\LaravelBlog\Models\M4BlogPost;
use M4tlch\LaravelBlog\Requests\AddNewCommentRequest;

/**
 * Class M4BlogCommentWriterController
 * @package M4tlch\LaravelBlog\Controllers
 */
class M4BlogCommentWriterController extends Controller
{

    use UsesCaptcha;

    /**
     * Let a guest (or logged in user) submit a new comment for a blog post
     *
     * @param AddNewCommentRequest $request
     * @param $blog_post_slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function addNewComment(AddNewCommentRequest $request, $blog_post_slug)
    {

        if (config("m4blog.comments.type_of_comments_to_show", "built_in") !== 'built_in') {
            throw new \RuntimeException("Built in comments are disabled");
        }

        $blog_post = M4BlogPost::where("slug", $blog_post_slug)
            ->firstOrFail();

        /** @var CaptchaAbstract $captcha */
        $captcha = $this->getCaptchaObject();
        if ($captcha) {
            $captcha->runCaptchaBeforeAddingComment($request, $blog_post);
        }

        $new_comment = $this->createNewComment($request, $blog_post);

        return view("m4blog::saved_comment", [
            'captcha' => $captcha,
            'blog_post' => $blog_post,
            'new_comment' => $new_comment
        ]);

    }

    /**
     * @param AddNewCommentRequest $request
     * @param $blog_post
     * @return M4BlogComment
     */
    protected function createNewComment(AddNewCommentRequest $request, $blog_post)
    {
        $new_comment = new M4BlogComment($request->all());

        if (config("m4blog.comments.save_ip_address")) {
            $new_comment->ip = $request->ip();
        }
        if (config("m4blog.comments.ask_for_author_website")) {
            $new_comment->author_website = $request->get('author_website');
        }
        if (config("m4blog.comments.ask_for_author_website")) {
            $new_comment->author_email = $request->get('author_email');
        }
        if (config("m4blog.comments.save_user_id_if_logged_in", true) && Auth::check()) {
            $new_comment->user_id = Auth::user()->id;
        }

        $new_comment->approved = config("m4blog.comments.auto_approve_comments", true) ? true : false;

        $blog_post->comments()->save($new_comment);

        event(new CommentAdded($blog_post, $new_comment));

        return $new_comment;
    }

}
