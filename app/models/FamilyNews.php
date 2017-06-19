<?php

/**
 * FamilyNews
 *
 * @property integer $id 
 * @property integer $family_id 家族ID
 * @property string $title 标题
 * @property string $content 传记内容
 * @property boolean $status 状态 1：正常；2：删除
 * @property boolean $category 分类
 * @property integer $author 作者
 * @property integer $last_editor 最后编辑者
 * @property \Carbon\Carbon $created_at 添加时间
 * @property \Carbon\Carbon $updated_at 最后修改时间
 * @method static \Illuminate\Database\Query\Builder|\FamilyNews whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyNews whereFamilyId($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyNews whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyNews whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyNews whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyNews whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyNews whereAuthor($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyNews whereLastEditor($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyNews whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyNews whereUpdatedAt($value)
 */
class FamilyNews extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'family_news';

}
