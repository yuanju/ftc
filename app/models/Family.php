<?php

/**
 * Family
 *
 * @property integer $id 
 * @property string $name 家族名称
 * @property string $family_name 姓氏
 * @property integer $owner 家族超级管理员ID
 * @property boolean $is_member 是否是会员 1是；2不是
 * @property boolean $is_open 是否公开 1：公开(公开到家普广场)；2 : 不公开
 * @property boolean $status 是否启用 1:启用；2：弃用
 * @property \Carbon\Carbon $created_at 添加时间
 * @property \Carbon\Carbon $updated_at 修改时间
 * @method static \Illuminate\Database\Query\Builder|\Family whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Family whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Family whereFamilyName($value)
 * @method static \Illuminate\Database\Query\Builder|\Family whereOwner($value)
 * @method static \Illuminate\Database\Query\Builder|\Family whereIsMember($value)
 * @method static \Illuminate\Database\Query\Builder|\Family whereIsOpen($value)
 * @method static \Illuminate\Database\Query\Builder|\Family whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\Family whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Family whereUpdatedAt($value)
 */
class Family extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'family';

}
