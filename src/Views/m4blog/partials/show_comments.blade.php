@switch(config("m4blog.comments.type_of_comments_to_show","built_in"))

@case("built_in")
{{-- default - show our own comments--}}
@include("m4blog::partials.built_in_comments")
@include("m4blog::partials.add_comment_form")
@break

@case("disqus")
{{--use disqus--}}
@include("m4blog::partials.disqus_comments")
@break


@case("custom")
{{--use custom - you should create the custom_comments in your vendor view dir and customise it--}}
@include("m4blog::partials.custom_comments")
@break

@case("disabled")
{{--comments are disabled--}}
<?php
return;  // not required, as we already filter for this
?>
@break

@default
{{--uh oh! we have an error!--}}
<div class='alert alert-danger'>Invalid comment <code>type_of_comments_to_show</code> config option</div>";
@endswitch


