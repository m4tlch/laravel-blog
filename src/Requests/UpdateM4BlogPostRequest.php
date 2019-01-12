<?php

namespace M4tlch\LaravelBlog\Requests;


use Illuminate\Validation\Rule;
use M4tlch\LaravelBlog\Models\M4BlogPost;
use M4tlch\LaravelBlog\Requests\Traits\HasCategoriesTrait;
use M4tlch\LaravelBlog\Requests\Traits\HasImageUploadTrait;

class UpdateM4BlogPostRequest  extends BaseM4BlogPostRequest {

    use HasCategoriesTrait;
    use HasImageUploadTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $return = $this->baseBlogPostRules();
        $return['slug'] [] = Rule::unique("m4_blog_posts", "slug")->ignore($this->route()->parameter("blogPostId"));
        return $return;
    }
}
