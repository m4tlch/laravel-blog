<?php

namespace M4tlch\LaravelBlog\Requests;


use Illuminate\Validation\Rule;
use M4tlch\LaravelBlog\Models\M4BlogCategory;

class UpdateM4BlogCategoryRequest extends BaseM4BlogCategoryRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $return = $this->baseCategoryRules();
        $return['slug'] [] = Rule::unique("blog_etc_categories", "slug")->ignore($this->route()->parameter("categoryId"));
        return $return;

    }
}
