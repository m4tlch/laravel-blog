@extends("m4blog_admin::layouts.admin_layout")
@section("content")


    <h5>Admin - Editing post
    <a target='_blank' href='{{$post->url()}}' class='float-right btn btn-primary'>View post</a>
    </h5>

    <form method='post' action='{{route("m4blog.admin.update_post",$post->id)}}'  enctype="multipart/form-data" >

        @csrf
        @method("patch")
        @include("m4blog_admin::posts.form", ['post' => $post])

        <input type='submit' class='btn btn-primary' value='Save Changes' >

    </form>

@endsection