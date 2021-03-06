<?php

namespace M4tlch\LaravelBlog\Middleware;

use Closure;

/**
 * Class UserCanManageBlogPosts
 * @package M4tlch\LaravelBlog\Middleware
 */
class UserCanManageBlogPosts
{

    /**
     * Show 401 error if \Auth::user()->canManageM4BlogPosts() == false
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::check()) {
            abort(401,"User not authorised to manage blog posts: You are not logged in");
        }
        if (!\Auth::user()->canManageM4BlogPosts()) {
            abort(401,"User not authorised to manage blog posts: Your account is not authorised to edit blog posts");
        }
        return $next($request);
    }
}
