<?php

class SysHelperController extends BaseController {

    function __construct (){
        if(!Auth::check()){
            return Redirect::to('login')->with('warning_message', '请首先登录！');
        }
    }
    
    public function index() {
        $helper_list = SysHelper::paginate(5);
        return View::make('sysHelper.index')->with('helper_list',$helper_list);
    }
    
}
