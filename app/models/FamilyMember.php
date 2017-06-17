<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;


class FamilyMember extends Eloquent implements UserInterface, RemindableInterface {
    use UserTrait, RemindableTrait;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'family_member';

    /**
     * 注册规则
     * @var array
     */
    public static $register_rules
        = array(
            'mobile'                => 'required|digits:11',
            'password'              => 'required|alpha_num|between:6,12|confirmed',
            'password_confirmation' => 'required|alpha_num|between:6,12'
        );
    
    /**
     * 登录规则
     * @var array
     */
    public static $login_rules
        = array(
            'mobile'                => 'required|digits:11',
            'password'              => 'required|alpha_num|between:6,12',
        );
}
