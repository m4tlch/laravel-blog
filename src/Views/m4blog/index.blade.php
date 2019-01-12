@extends("layouts.app",['title'=>$title])
@section("content")

    {{--https://nikacrm.com/laravel/packages/m4blog-blog-system-for-your-laravel-app/help-documentation/laravel-blog-package-m4blog#guide_to_views--}}

    <div class='row'>
        <div class='col-sm-12 m4blog_container'>
            @if(\Auth::check() && \Auth::user()->canManageM4BlogPosts())
                <div class="text-center">
                        <p class='mb-1'>You are logged in as a blog admin user.
                            <br>

                            <a href='{{route("m4blog.admin.index")}}'
                               class='btn border  btn-outline-primary btn-sm '>

                                <i class="fa fa-cogs" aria-hidden="true"></i>

                                Go To Blog Admin Panel</a>


                        </p>
                </div>
            @endif


            @if(isset($m4blog_category) && $m4blog_category)
                <h2 class='text-center'>Viewing Category: {{$m4blog_category->category_name}}</h2>

                @if($m4blog_category->category_description)
                    <p class='text-center'>{{$m4blog_category->category_description}}</p>
                @endif

            @endif


            @forelse($posts as $post)
                @include("m4blog::partials.index_loop")
            @empty
                <div class='alert alert-danger'>No posts</div>
            @endforelse

            <div class='text-center  col-sm-4 mx-auto'>
                {{$posts->appends( [] )->links()}}
            </div>




                @include("m4blog::sitewide.search_form")

        </div>
    </div>
@endsection