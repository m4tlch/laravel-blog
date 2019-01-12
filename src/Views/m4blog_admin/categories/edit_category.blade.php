@extends("m4blog_admin::layouts.admin_layout")
@section("content")


    <h5>Admin - Edit Category</h5>

    <form method='post' action='{{route("m4blog.admin.categories.edit_category",$category->id)}}'  enctype="multipart/form-data" >

        @csrf
        @method("patch")
        @include("m4blog_admin::categories.form", ['category' => $category])

        <input type='submit' class='btn btn-primary' value='Save Changes' >

    </form>

@endsection