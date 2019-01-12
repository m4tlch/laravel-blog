@extends("m4blog_admin::layouts.admin_layout")
@section("content")


    <h5>Admin - Add Category</h5>

    <form method='post' action='{{route("m4blog.admin.categories.create_category")}}'  enctype="multipart/form-data" >

        @csrf
        @include("m4blog_admin::categories.form", ['category' => new \M4tlch\LaravelBlog\Models\M4BlogCategory()])

        <input type='submit' class='btn btn-primary' value='Add new category' >

    </form>

@endsection