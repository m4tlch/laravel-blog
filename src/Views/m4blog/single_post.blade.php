@extends("layouts.app",['title'=>$post->gen_seo_title(), 'meta_desc' => $post->gen_meta_desc()] )
@section("content")


    {{--https://nikacrm.com/laravel/packages/m4blog-blog-system-for-your-laravel-app/help-documentation/laravel-blog-package-m4blog#guide_to_views--}}

    <div class='container'>
        <div class='row'>
            <div class='col-sm-12 col-md-12 col-lg-12'>

                @include("m4blog::partials.show_errors")
                @include("m4blog::partials.full_post_details")


                @if(config("m4blog.comments.type_of_comments_to_show","built_in") !== 'disabled')
                    <div class="" id='maincommentscontainer'>
                        <h2 class='text-center' id='m4blogcomments'>Comments</h2>
                        @include("m4blog::partials.show_comments")
                    </div>
                @else
                    {{--Comments are disabled--}}
                @endif


            </div>
        </div>
    </div>

@endsection