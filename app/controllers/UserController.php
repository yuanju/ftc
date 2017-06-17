<?php

class UserController extends BaseController {
    
    public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
    }
    /**
     * 用户登录
     * @author 齐元举<qiyuanju@51talk.com>
     * @return mixed
     */
    public function login() {
        return View::make('user.login');
    }
    
    /**
     * 用户登录
     * @author 齐元举<qiyuanju@51talk.com>
     * @return mixed
     */
    public function doLogin() {
        $messages = array(
            'required' => '请填写 :attribute。',
            'digits' => ':attribute 长度不能小于11。',
            'alpha_num' => '密码必需为数据或字母。',
            'between' => '密码长度必需在6到12位之间。',
        );
        $validator = Validator::make(Input::all(), FamilyMember::$login_rules, $messages);
        if ($validator->passes()) {
            $attempt = Auth::attempt(array('mobile' => Input::get('mobile'), 'password' => Input::get('password')), Input::get('remember-me'));
            if ($attempt) {
                return Redirect::to('family')->with('success_message', '登录成功！');
            }else{
                return Redirect::to('login')->with('warning_message', '手机号或密码错误');
            }
        }else{
            return Redirect::to('login')->with('warning_message', $validator->messages()->first());
        }
    }

    /**
     * 退出登录
     * @author 齐元举<qiyuanju@51talk.com>
     * @return mixed
     */
    public function logout(){
        Auth::logout();
        return Redirect::to('login');
    }

    

    /**
     * 用户注册
     * @author 齐元举<qiyuanju@51talk.com>
     * @return mixed
     */
    public function register() {
        return View::make('user.register');
    }

    /**
     * 用户登录
     * @author 齐元举<qiyuanju@51talk.com>
     * @return mixed
     */
    public function doRegister() {
        $messages = array(
            'required' => '请填写 :attribute。',
            'digits' => ':attribute 长度不能小于11。',
            'alpha_num' => '密码必需为数据或字母。',
            'between' => '密码长度必需在6到12位之间。',
            'confirmed' => '重复密码必需与密码保持一致。',
        );
        $validator = Validator::make(Input::all(), FamilyMember::$register_rules, $messages);
        if ($validator->passes()) {
            $family_member = new FamilyMember();
            $family_member->mobile = Input::get('mobile');
            $family_member->password = Hash::make(Input::get('password'));
            $family_member->is_activated = 1;
            $family_member->save();
            // 验证通过就存储用户数据
            return Redirect::to('login')->with('success_message', '注册成功!');
        } else {
            // 验证没通过就显示错误提示信息
            return Redirect::to('register')->with('warning_message', $validator->messages()->first()); 
        }
        exit;
        return Redirect::to('family');
    }

}
