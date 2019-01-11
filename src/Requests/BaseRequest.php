<?php

namespace M4tlch\LaravelBlog\Requests;

use Illuminate\Foundation\Http\FormRequest;
use M4tlch\LaravelBlog\Interfaces\BaseRequestInterface;

/**
 * Class BaseRequest
 * @package M4tlch\LaravelBlog\Requests
 */
abstract class BaseRequest extends FormRequest implements BaseRequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check() && \Auth::user()->canManageM4BlogPosts();
    }
}
