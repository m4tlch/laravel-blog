<?php

namespace M4tlch\LaravelBlog\Controllers;

use App\Http\Controllers\Controller;
use M4tlch\LaravelBlog\Events\CategoryAdded;
use M4tlch\LaravelBlog\Events\CategoryEdited;
use M4tlch\LaravelBlog\Events\CategoryWillBeDeleted;
use M4tlch\LaravelBlog\Helpers;
use M4tlch\LaravelBlog\Middleware\UserCanManageBlogPosts;
use M4tlch\LaravelBlog\Models\M4BlogCategory;
use M4tlch\LaravelBlog\Requests\DeleteM4BlogCategoryRequest;
use M4tlch\LaravelBlog\Requests\StoreM4BlogCategoryRequest;
use M4tlch\LaravelBlog\Requests\UpdateM4BlogCategoryRequest;

/**
 * Class M4BlogCategoryAdminController
 * @package M4tlch\LaravelBlog\Controllers
 */
class M4BlogCategoryAdminController extends Controller
{
    /**
     * M4BlogCategoryAdminController constructor.
     */
    public function __construct()
    {
        $this->middleware(UserCanManageBlogPosts::class);
    }

    /**
     * Show list of categories
     *
     * @return mixed
     */
    public function index(){

        $categories = M4BlogCategory::orderBy("category_name")->paginate(25);
        return view("blogetc_admin::categories.index")->withCategories($categories);
    }

    /**
     * Show the form for creating new category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create_category(){

        return view("blogetc_admin::categories.add_category");

    }

    /**
     * Store a new category
     *
     * @param StoreM4BlogCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store_category(StoreM4BlogCategoryRequest $request){
        $new_category = new M4BlogCategory($request->all());
        $new_category->save();

        Helpers::flash_message("Saved new category");

        event(new CategoryAdded($new_category));
        return redirect( route('blogetc.admin.categories.index') );
    }

    /**
     * Show the edit form for category
     * @param $categoryId
     * @return mixed
     */
    public function edit_category($categoryId){
        $category = M4BlogCategory::findOrFail($categoryId);
        return view("blogetc_admin::categories.edit_category")->withCategory($category);
    }

    /**
     * Save submitted changes
     *
     * @param UpdateM4BlogCategoryRequest $request
     * @param $categoryId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update_category(UpdateM4BlogCategoryRequest $request, $categoryId){
        /** @var M4BlogCategory $category */
        $category = M4BlogCategory::findOrFail($categoryId);
        $category->fill($request->all());
        $category->save();

        Helpers::flash_message("Saved category changes");
        event(new CategoryEdited($category));
        return redirect($category->edit_url());
    }

    /**
     * Delete the category
     *
     * @param DeleteM4BlogCategoryRequest $request
     * @param $categoryId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy_category(DeleteM4BlogCategoryRequest $request, $categoryId){

        /* Please keep this in, so code inspections don't say $request was unused. Of course it might now get marked as left/right parts are equal */
        $request=$request;

        $category = M4BlogCategory::findOrFail($categoryId);
        event(new CategoryWillBeDeleted($category));
        $category->delete();

        return view ("blogetc_admin::categories.deleted_category");

    }

}
