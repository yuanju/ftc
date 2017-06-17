<?php

class SysNoticeController extends BaseController {

    function __construct (){
        if(!Auth::check()){
            return Redirect::to('login')->with('warning_message', '请首先登录！');
        }
    }
    
    public function index() {
        return View::make('sysNotice.index');
    }
    
}
