<?php

Route::group(['middleware' => ['web'], 'namespace' => '\M4tlch\LaravelBlog\Controllers'], function () {


    /** The main public facing blog routes - show all posts, view a category, rss feed, view a single post, also the add comment route */
    Route::group(['prefix' => config('m4blog.blog_prefix', 'blog')], function () {

        Route::get('/', 'M4BlogReaderController@index')
            ->name('m4blog.index');

        Route::get('/search', 'M4BlogReaderController@search')
            ->name('m4blog.search');

        Route::get('/feed', 'M4BlogRssFeedController@feed')
            ->name('m4blog.feed'); //RSS feed

        Route::get('/category/{categorySlug}',
            'M4BlogReaderController@view_category')
            ->name('m4blog.view_category');

        Route::get('/{blogPostSlug}',
            'M4BlogReaderController@viewSinglePost')
            ->name('m4blog.single');


        // throttle to a max of 10 attempts in 3 minutes:
        Route::group(['middleware' => 'throttle:10,3'], function () {

            Route::post('save_comment/{blogPostSlug}',
                'M4BlogCommentWriterController@addNewComment')
                ->name('m4blog.comments.add_new_comment');


        });

    });


    /* Admin backend routes - CRUD for posts, categories, and approving/deleting submitted comments */
    Route::group(['prefix' => config('m4blog.admin_prefix', 'blog_admin')], function () {

        Route::get('/', 'M4BlogAdminController@index')
            ->name('m4blog.admin.index');

        Route::get('/add_post',
            'M4BlogAdminController@create_post')
            ->name('m4blog.admin.create_post');


        Route::post('/add_post',
            'M4BlogAdminController@store_post')
            ->name('m4blog.admin.store_post');


        Route::get('/edit_post/{blogPostId}',
            'M4BlogAdminController@edit_post')
            ->name('m4blog.admin.edit_post');

        Route::patch('/edit_post/{blogPostId}',
            'M4BlogAdminController@update_post')
            ->name('m4blog.admin.update_post');


        Route::group(['prefix' => "image_uploads",], function () {

            Route::get("/", "M4BlogImageUploadController@index")->name("m4blog.admin.images.all");

            Route::get("/upload", "M4BlogImageUploadController@create")->name("m4blog.admin.images.upload");
            Route::post("/upload", "M4BlogImageUploadController@store")->name("m4blog.admin.images.store");

        });


        Route::delete('/delete_post/{blogPostId}',
            'M4BlogAdminController@destroy_post')
            ->name('m4blog.admin.destroy_post');

        Route::group(['prefix' => 'comments',], function () {

            Route::get('/',
                'M4BlogCommentsAdminController@index')
                ->name('m4blog.admin.comments.index');

            Route::patch('/{commentId}',
                'M4BlogCommentsAdminController@approve')
                ->name('m4blog.admin.comments.approve');
            Route::delete('/{commentId}',
                'M4BlogCommentsAdminController@destroy')
                ->name('m4blog.admin.comments.delete');
        });

        Route::group(['prefix' => 'categories'], function () {

            Route::get('/',
                'M4BlogCategoryAdminController@index')
                ->name('m4blog.admin.categories.index');

            Route::get('/add_category',
                'M4BlogCategoryAdminController@create_category')
                ->name('m4blog.admin.categories.create_category');
            Route::post('/add_category',
                'M4BlogCategoryAdminController@store_category')
                ->name('m4blog.admin.categories.store_category');

            Route::get('/edit_category/{categoryId}',
                'M4BlogCategoryAdminController@edit_category')
                ->name('m4blog.admin.categories.edit_category');

            Route::patch('/edit_category/{categoryId}',
                'M4BlogCategoryAdminController@update_category')
                ->name('m4blog.admin.categories.update_category');

            Route::delete('/delete_category/{categoryId}',
                'M4BlogCategoryAdminController@destroy_category')
                ->name('m4blog.admin.categories.destroy_category');

        });

    });
});

