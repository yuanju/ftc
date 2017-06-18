<?php

class FamilyBiographyController extends BaseController {

    function __construct (){
        if(!Auth::check()){
            return Redirect::to('login')->with('warning_message', '请首先登录！');
        }
    }
    
    public function index() {
        $biography_list = FamilyBiography::where('id', '>', '0')->paginate(10);
        return View::make('familyBiography.index')->with('biography_list',$biography_list)
            ;
    }

    /**
     * 添加
     * @author 齐元举<qiyuanju@51talk.com>
     */
    public function edit(){
        $id = intval(Input::get('id'));
        $article = array();
        if($id){
            $family_id =Auth::user()->father_family_id;
            $article = FamilyBiography::whereRaw('id= ? and family_id = ?',array($id, $family_id))->first();
        }
        $article_template_list = ArticleTemplate::all();
        return View::make('familyBiography.edit')
                   ->with('template_list',$article_template_list)
                   ->with('id',$id)
                   ->with('article',$article);
    }

    /**
     * 保存
     * @author 齐元举<qiyuanju@51talk.com>
     */
    public function doEdit()
    {
        $id = intval(Input::get('id'));
        if($id){
            $family_biography_modal = FamilyBiography::find($id);
            if($family_biography_modal->family_id != Auth::user()->father_family_id){
                //todo 失败
            }
        }else{
            $family_biography_modal = new FamilyBiography();
        }
        $family_biography_modal->family_id = Auth::user()->father_family_id;
        $family_biography_modal->author = Auth::user()->id;
        $family_biography_modal->title = addslashes(trim(Input::get('title')));
        $family_biography_modal->content = addslashes(trim(Input::get('content')));
        $family_biography_modal->last_editor = Auth::user()->id;
        $rs = $family_biography_modal->save();
        if($rs){
            return Redirect::to('familyBiography');
        }else{
            return Redirect::to('familyBiography/edit');
        }
    }
}
