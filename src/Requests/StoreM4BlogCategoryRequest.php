<?php
namespace M4tlch\LaravelBlog\Requests;


use Illuminate\Validation\Rule;

class StoreM4BlogCategoryRequest extends BaseM4BlogCategoryRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $return = $this->baseCategoryRules();
        $return['slug'] [] = Rule::unique("m4_blog_categories", "slug");
        return $return;
    }
}
