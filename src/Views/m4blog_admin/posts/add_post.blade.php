@extends("m4blog_admin::layouts.admin_layout")
@section("content")


    <h5>Admin - Add post</h5>

    <form method='post' action='{{route("m4blog.admin.store_post")}}'  enctype="multipart/form-data" >

        @csrf
        @include("m4blog_admin::posts.form", ['post' => new \M4tlch\LaravelBlog\Models\M4BlogPost()])

        <input type='submit' class='btn btn-primary' value='Add new post' >

    </form>

@endsection