<?php namespace M4tlch\LaravelBlog\Interfaces;

interface BaseRequestInterface
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules();
}