<?php

/**
 * FamilyBiography
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
 * @method static \Illuminate\Database\Query\Builder|\FamilyBiography whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyBiography whereFamilyId($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyBiography whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyBiography whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyBiography whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyBiography whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyBiography whereAuthor($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyBiography whereLastEditor($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyBiography whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\FamilyBiography whereUpdatedAt($value)
 */
class FamilyBiography extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'family_biography';

}
