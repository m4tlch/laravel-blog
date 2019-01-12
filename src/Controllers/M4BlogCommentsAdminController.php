<?php

namespace M4tlch\LaravelBlog\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use M4tlch\LaravelBlog\Events\CommentApproved;
use M4tlch\LaravelBlog\Events\CommentWillBeDeleted;
use M4tlch\LaravelBlog\Helpers;
use M4tlch\LaravelBlog\Middleware\UserCanManageBlogPosts;
use M4tlch\LaravelBlog\Models\M4BlogComment;

/**
 * Class M4BlogCommentsAdminController
 * @package M4tlch\LaravelBlog\Controllers
 */
class M4BlogCommentsAdminController extends Controller
{
    /**
     * M4BlogCommentsAdminController constructor.
     */
    public function __construct()
    {
        $this->middleware(UserCanManageBlogPosts::class);
    }

    /**
     * Show all comments (and show buttons with approve/delete)
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $comments = M4BlogComment::withoutGlobalScopes()->orderBy("created_at", "desc")
            ->with("post");

        if ($request->get("waiting_for_approval")) {
            $comments->where("approved", false);
        }

        $comments = $comments->paginate(100);
        return view("m4blog_admin::comments.index")
            ->withComments($comments
            );
    }


    /**
     * Approve a comment
     *
     * @param $blogCommentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve($blogCommentId)
    {
        $comment = M4BlogComment::withoutGlobalScopes()->findOrFail($blogCommentId);
        $comment->approved = true;
        $comment->save();

        Helpers::flash_message("Approved!");
        event(new CommentApproved($comment));

        return back();

    }

    /**
     * Delete a submitted comment
     *
     * @param $blogCommentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($blogCommentId)
    {
        $comment = M4BlogComment::withoutGlobalScopes()->findOrFail($blogCommentId);
        event(new CommentWillBeDeleted($comment));

        $comment->delete();

        Helpers::flash_message("Deleted!");
        return back();
    }


}
