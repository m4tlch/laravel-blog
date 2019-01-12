<p>Welcome to the admin panel for your blog posts.</p>


<ul class="list-group mb-3">
    <li class="list-group-item justify-content-between lh-condensed">
        <div>
            <h6 class="my-0"><a href="{{ route('m4blog.admin.index') }}">Admin Home</a>
             <span class="text-muted">(<?php
                 $categoryCount = \M4tlch\LaravelBlog\Models\M4BlogPost::count();

                 echo $categoryCount . " " . str_plural("Post", $categoryCount);

                 ?>)</span>
            </h6>
            <small class="text-muted">Overview of your posts</small>

            <div class="list-group ">

                <a href='{{ route('m4blog.admin.index') }}'
                   class='list-group-item list-group-item-action @if(\Request::route()->getName() === 'm4blog.admin.index') active @endif  '><i
                            class="fa fa-th fa-fw"
                            aria-hidden="true"></i>
                    All Posts</a>
                <a href='{{ route('m4blog.admin.create_post') }}'
                   class='list-group-item list-group-item-action  @if(\Request::route()->getName() === 'm4blog.admin.create_post') active @endif  '><i
                            class="fa fa-plus fa-fw" aria-hidden="true"></i>
                    Add Post</a>
            </div>
        </div>

    </li>


    <li class="list-group-item justify-content-between lh-condensed">
        <div>
            <h6 class="my-0"><a href="{{ route('m4blog.admin.comments.index') }}">Comments</a>

                            <span class="text-muted">(<?php
                                $commentCount = \M4tlch\LaravelBlog\Models\M4BlogComment::withoutGlobalScopes()->count();

                                echo $commentCount . " " . str_plural("Comment", $commentCount);

                                ?>)</span>
            </h6>
            <small class="text-muted">Manage your comments</small>

            <div class="list-group ">
                <a href='{{ route('m4blog.admin.comments.index') }}'
                   class='list-group-item list-group-item-action  @if(\Request::route()->getName() === 'm4blog.admin.comments.index' && !\Request::get("waiting_for_approval")) active @endif   '><i
                            class="fa  fa-fw fa-comments" aria-hidden="true"></i>
                    All Comments</a>


                <?php $comment_approval_count = \M4tlch\LaravelBlog\Models\M4BlogComment::withoutGlobalScopes()->where("approved", false)->count(); ?>

                <a href='{{ route('m4blog.admin.comments.index') }}?waiting_for_approval=true'
                   class='list-group-item list-group-item-action  @if(\Request::route()->getName() === 'm4blog.admin.comments.index' && \Request::get("waiting_for_approval")) active @elseif($comment_approval_count>0) list-group-item-warning @endif  '><i
                            class="fa  fa-fw fa-comments" aria-hidden="true"></i>
                    {{ $comment_approval_count }}
                    Waiting for approval </a>

            </div>
        </div>
    </li>


    <li class="list-group-item  justify-content-between lh-condensed">
        <div>
            <h6 class="my-0"><a href="{{ route('m4blog.admin.categories.index') }}">Categories</a>
                    <span class="text-muted">(<?php
                        $postCount = \M4tlch\LaravelBlog\Models\M4BlogCategory::count();
                        echo $postCount . " " . str_plural("Category", $postCount);
                        ?>)</span>
            </h6>


            <small class="text-muted">Blog post categories</small>

            <div class="list-group ">
                <a href='{{ route('m4blog.admin.categories.index') }}'
                   class='list-group-item list-group-item-action  @if(\Request::route()->getName() === 'm4blog.admin.categories.index') active @endif  '><i
                            class="fa fa-object-group fa-fw" aria-hidden="true"></i>
                    All Categories</a>
                <a href='{{ route('m4blog.admin.categories.create_category') }}'
                   class='list-group-item list-group-item-action  @if(\Request::route()->getName() === 'm4blog.admin.categories.create_category') active @endif  '><i
                            class="fa fa-plus fa-fw" aria-hidden="true"></i>
                    Add Category</a>
            </div>
        </div>

    </li>

    @if(config("m4blog.image_upload_enabled"))
    <li class="list-group-item  justify-content-between lh-condensed">
        <div>
            <h6 class="my-0"><a href="{{ route('m4blog.admin.images.upload') }}">Upload images</a></h6>


            <div class="list-group ">

                <a href='{{ route('m4blog.admin.images.all') }}'
                   class='list-group-item list-group-item-action  @if(\Request::route()->getName() === 'm4blog.admin.images.all') active @endif  '><i
                            class="fa fa-picture-o fa-fw" aria-hidden="true"></i>
                    View All</a>



                <a href='{{ route('m4blog.admin.images.upload') }}'
                   class='list-group-item list-group-item-action  @if(\Request::route()->getName() === 'm4blog.admin.images.upload') active @endif  '><i
                            class="fa fa-upload fa-fw" aria-hidden="true"></i>
                    Upload</a>


            </div>


        </div>

    </li>
        @endif


</ul>