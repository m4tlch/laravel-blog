<?php

namespace M4tlch\LaravelBlog;

use Illuminate\Support\ServiceProvider;
use Swis\LaravelFulltext\ModelObserver;
use M4tlch\LaravelBlog\Models\M4BlogPost;

class M4BlogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if (config("m4blog.search.search_enabled") == false) {
            // if search is disabled, don't allow it to sync.
            ModelObserver::disableSyncingFor(M4BlogPost::class);
        }

        if (config("m4blog.include_default_routes", true)) {
            include(__DIR__ . "/routes.php");
        }


        foreach ([
                     '2018_05_28_224023_create_m4_blog_posts_table.php',
                     '2018_09_16_224023_add_author_and_url_m4_blog_posts_table.php',
                     '2018_09_26_085711_add_short_desc_textrea_to_m4_blog.php',
                     '2018_09_27_122627_create_m4_blog_uploaded_photos_table.php'
                 ] as $file) {

            $this->publishes([
                __DIR__ . '/../migrations/' . $file => database_path('migrations/' . $file)
            ]);

        }

        $this->publishes([
            __DIR__ . '/Views/m4blog' => base_path('resources/views/vendor/m4blog'),
            __DIR__ . '/Config/m4blog.php' => config_path('m4blog.php'),
            __DIR__ . '/css/m4blog_admin_css.css' => public_path('m4blog_admin_css.css'),
        ]);


    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        // for the admin backend views ( view("m4blog_admin::BLADEFILE") )
        $this->loadViewsFrom(__DIR__ . "/Views/m4blog_admin", 'm4blog_admin');

        // for public facing views (view("m4blog::BLADEFILE")):
        // if you do the vendor:publish, these will be copied to /resources/views/vendor/m4blog anyway
        $this->loadViewsFrom(__DIR__ . "/Views/m4blog", 'm4blog');
    }

}
