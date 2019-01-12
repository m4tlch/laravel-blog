<?php namespace M4tlch\LaravelBlog\Captcha;

use Illuminate\Http\Request;
use M4tlch\LaravelBlog\Interfaces\CaptchaInterface;
use M4tlch\LaravelBlog\Models\M4BlogPost;

abstract class CaptchaAbstract implements CaptchaInterface
{


    /**
     * executed when viewing single post
     *
     * @param Request $request
     * @param M4BlogPost $m4BlogPost
     *
     * @return void
     */
    public function runCaptchaBeforeShowingPosts(Request $request, M4BlogPost $m4BlogPost)
    {
        // no code here to run! Maybe in your subclass you can make use of this?
        /*

        But you could put something like this -
        $some_question = ...
        $correct_captcha = ...
        \View::share("correct_captcha",$some_question); // << reference this in the view file.
        \Session::put("correct_captcha",$correct_captcha);


        then in the validation rules you can check if the submitted value matched the above value. You will have to implement this.

        */
    }

    /**
     * executed when posting new comment
     *
     * @param Request $request
     * @param M4BlogPost $m4BlogPost
     *
     * @return void
     */
    public function runCaptchaBeforeAddingComment(Request $request, M4BlogPost $m4BlogPost)
    {
        // no code here to run! Maybe in your subclass you can make use of this?
    }

}