<?php

namespace M4tlch\LaravelBlog\Requests;


use Illuminate\Validation\Rule;
use M4tlch\LaravelBlog\Requests\Traits\HasCategoriesTrait;
use M4tlch\LaravelBlog\Requests\Traits\HasImageUploadTrait;

class CreateM4BlogPostRequest extends BaseM4BlogPostRequest
{
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
        $return['slug'] [] = Rule::unique("m4_blog_posts", "slug");
        return $return;
    }

}
