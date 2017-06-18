<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;


/**
 * FamilyMember
 *
 * @property integer $id 
 * @property string $mobile 手机号
 * @property string $password 密码
 * @property string $remember_token 记住密码
 * @property boolean $is_activated 是否为已激活 1：是；2：否
 * @property integer $father_family_id 父家族ID
 * @property integer $mother_family_id 母家族ID
 * @property integer $household_id 所属家庭ID
 * @property string $name 姓名
 * @property string $avatar 成员头像
 * @property string $family_name 姓氏
 * @property string $job 职位
 * @property string $address 住址
 * @property integer $age 年龄
 * @property string $birthday 生日
 * @property string $diedday 死亡日期
 * @property boolean $sex 性别，1：男；2：女
 * @property boolean $living 是否在世，1：在世，2：离世
 * @property boolean $status 是否启用 1:启用；2：弃用
 * @property \Carbon\Carbon $created_at 创建时间
 * @property \Carbon\Carbon $updated_at 修改时间
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereMobile($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereIsActivated($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereFatherFamilyId($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereMotherFamilyId($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereHouseholdId($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereFamilyName($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereJob($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereAge($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereBirthday($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereDiedday($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereSex($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereLiving($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyMember whereUpdatedAt($value)
 */
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
