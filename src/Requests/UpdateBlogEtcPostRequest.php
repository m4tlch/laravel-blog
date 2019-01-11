<?php

namespace M4tlch\LaravelBlog\Requests;


use Illuminate\Validation\Rule;
use M4tlch\LaravelBlog\Models\BlogEtcPost;
use M4tlch\LaravelBlog\Requests\Traits\HasCategoriesTrait;
use M4tlch\LaravelBlog\Requests\Traits\HasImageUploadTrait;

class UpdateBlogEtcPostRequest  extends BaseBlogEtcPostRequest {

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
        $return['slug'] [] = Rule::unique("blog_etc_posts", "slug")->ignore($this->route()->parameter("blogPostId"));
        return $return;
    }
}
