<?php

class FamilyMemberController extends BaseController {

    function __construct (){
        if(!Auth::check()){
            return Redirect::to('login')->with('warning_message', '请首先登录！');
        }
    }
    
    public function getList() {
//        echo 'this is family index';exit;
        $family_members = FamilyMember::paginate(2);
        return View::make('family_members')->with('family_members', $family_members);
    }

    /**
     *  编辑个人信息
     * @author 齐元举<qiyuanju@51talk.com>
     * @return mixed
     */
    public function edit() {
        return View::make('familyMember.edit');
    }
}
