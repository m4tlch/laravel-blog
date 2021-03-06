<?php

namespace M4tlch\LaravelBlog\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use M4tlch\LaravelBlog\Middleware\UserCanManageBlogPosts;
use M4tlch\LaravelBlog\Models\M4BlogUploadedPhoto;
use File;
use M4tlch\LaravelBlog\Requests\UploadImageRequest;
use M4tlch\LaravelBlog\Traits\UploadFileTrait;

/**
 * Class M4BlogAdminController
 * @package M4tlch\LaravelBlog\Controllers
 */
class M4BlogImageUploadController extends Controller
{

    use UploadFileTrait;

    /**
     * M4BlogAdminController constructor.
     */
    public function __construct()
    {
        $this->middleware(UserCanManageBlogPosts::class);

        if (!is_array(config("m4blog"))) {
            throw new \RuntimeException('The config/m4blog.php does not exist. Publish the vendor files for the M4Blog package by running the php artisan publish:vendor command');
        }


        if (!config("m4blog.image_upload_enabled")) {
            throw new \RuntimeException("The m4blog.php config option has not enabled image uploading");
        }


    }

    /**
     * Show the main listing of uploaded images
     * @return mixed
     */


    public function index()
    {
        return view("m4blog_admin::imageupload.index", ['uploaded_photos' => M4BlogUploadedPhoto::orderBy("id", "desc")->paginate(10)]);
    }

    /**
     * show the form for uploading a new image
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view("m4blog_admin::imageupload.create", []);
    }

    /**
     * Save a new uploaded image
     *
     * @param UploadImageRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function store(UploadImageRequest $request)
    {
        $processed_images = $this->processUploadedImages($request);

        return view("m4blog_admin::imageupload.uploaded", ['images' => $processed_images]);
    }

    /**
     * Process any uploaded images (for featured image)
     *
     * @param UploadImageRequest $request
     *
     * @return array returns an array of details about each file resized.
     * @throws \Exception
     * @todo - This class was added after the other main features, so this duplicates some code from the main blog post admin controller (M4BlogAdminController). For next full release this should be tided up.
     */
    protected function processUploadedImages(UploadImageRequest $request)
    {
        $this->increaseMemoryLimit();
        $photo = $request->file('upload');

        // to save in db later
        $uploaded_image_details = [];

        $sizes_to_upload = $request->get("sizes_to_upload");

        // now upload a full size - this is a special case, not in the config file. We only store full size images in this class, not as part of the featured blog image uploads.
        if (isset($sizes_to_upload['m4blog_full_size']) && $sizes_to_upload['m4blog_full_size'] === 'true') {

            $uploaded_image_details['m4blog_full_size'] = $this->UploadAndResize(null, $request->get("image_title"), 'fullsize', $photo);

        }

        foreach ((array)config('m4blog.image_sizes') as $size => $image_size_details) {

            if (!isset($sizes_to_upload[$size]) || !$sizes_to_upload[$size] || !$image_size_details['enabled']) {
                continue;
            }

            // this image size is enabled, and
            // we have an uploaded image that we can use
            $uploaded_image_details[$size] = $this->UploadAndResize(null, $request->get("image_title"), $image_size_details, $photo);
        }


        // store the image upload.
        M4BlogUploadedPhoto::create([
            'image_title' => $request->get("image_title"),
            'source' => "ImageUpload",
            'uploader_id' => optional(\Auth::user())->id,
            'uploaded_images' => $uploaded_image_details,
        ]);


        return $uploaded_image_details;

    }


}
