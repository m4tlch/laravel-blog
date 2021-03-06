<?php

namespace M4tlch\LaravelBlog\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Swis\LaravelFulltext\Search;
use M4tlch\LaravelBlog\Captcha\UsesCaptcha;
use M4tlch\LaravelBlog\Models\M4BlogCategory;
use M4tlch\LaravelBlog\Models\M4BlogPost;

/**
 * Class M4BlogReaderController
 * All of the main public facing methods for viewing blog content (index, single posts)
 * @package M4tlch\LaravelBlog\Controllers
 */
class M4BlogReaderController extends Controller
{
    use UsesCaptcha;

    /**
     * Show blog posts
     * If category_slug is set, then only show from that category
     *
     * @param null $category_slug
     * @return mixed
     */
    public function index($category_slug = null)
    {
        // the published_at + is_published are handled by M4BlogPublishedScope, and don't take effect if the logged in user can manageb log posts
        $title = 'Viewing blog'; // default title...

        if ($category_slug) {
            $category = M4BlogCategory::where("slug", $category_slug)->firstOrFail();
            $posts = $category->posts()->where("m4_blog_post_categories.m4_blog_category_id", $category->id);

            // at the moment we handle this special case (viewing a category) by hard coding in the following two lines.
            // You can easily override this in the view files.
            \View::share('m4blog_category', $category); // so the view can say "You are viewing $CATEGORYNAME category posts"
            $title = 'Viewing posts in ' . $category->category_name . " category"; // hardcode title here...
        } else {
            $posts = M4BlogPost::query();
        }

        $posts = $posts->orderBy("posted_at", "desc")
            ->paginate(config("m4blog.per_page", 10));

        return view("m4blog::index", [
            'posts' => $posts,
            'title' => $title,
        ]);
    }

    /**
     * Show the search results for $_GET['s']
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function search(Request $request)
    {
        if (!config("m4blog.search.search_enabled")) {
            throw new \Exception("Search is disabled");
        }
        $query = $request->get("s");
        $search = new Search();
        $search_results = $search->run($query);

        \View::share("title", "Search results for " . e($query));

        return view("m4blog::search", ['query' => $query, 'search_results' => $search_results]);

    }




    /**
     * View all posts in $category_slug category
     *
     * @param Request $request
     * @param $category_slug
     * @return mixed
     */
    public function view_category($category_slug)
    {
        return $this->index($category_slug);
    }

    /**
     * View a single post and (if enabled) it's comments
     *
     * @param Request $request
     * @param $blogPostSlug
     * @return mixed
     */
    public function viewSinglePost(Request $request, $blogPostSlug)
    {
        // the published_at + is_published are handled by M4BlogPublishedScope, and don't take effect if the logged in user can manage log posts
        $blog_post = M4BlogPost::where("slug", $blogPostSlug)
            ->firstOrFail();

        if ($captcha = $this->getCaptchaObject()) {
            $captcha->runCaptchaBeforeShowingPosts($request, $blog_post);
        }

        return view("m4blog::single_post", [
            'post' => $blog_post,
            // the default scope only selects approved comments, ordered by id
            'comments' => $blog_post->comments()
                ->with("user")
                ->get(),
            'captcha' => $captcha,
        ]);
    }






}
