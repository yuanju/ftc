<?php

/**
 * ArticleTemplate
 *
 * @property integer $id 
 * @property boolean $type 模板类型：1：标题；2：内容；3：图文；4：背景
 * @property string $section 模板内容
 * @property boolean $status 状态 1：启用；2：禁用
 * @property \Carbon\Carbon $updated_at 修改时间
 * @property \Carbon\Carbon $created_at  创建时间
 * @method static \Illuminate\Database\Query\Builder|\ArticleTemplate whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\ArticleTemplate whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\ArticleTemplate whereSection($value)
 * @method static \Illuminate\Database\Query\Builder|\ArticleTemplate whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\ArticleTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\ArticleTemplate whereCreatedAt($value)
 */
class ArticleTemplate extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'article_template';

}
