<?php

class FamilyBiographyController extends BaseController {

    function __construct (){
        if(!Auth::check()){
            return Redirect::to('login')->with('warning_message', '请首先登录！');
        }
    }
    
    public function index() {
        return View::make('familyBiography.index');
    }

    /**
     * 添加
     * @author 齐元举<qiyuanju@51talk.com>
     */
    public function add(){
        $article_template_list = ArticleTemplate::all();
        return View::make('familyBiography.add')->with('template_list',$article_template_list);
    }
}
