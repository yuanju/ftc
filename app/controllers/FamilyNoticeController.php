<?php

class FamilyNoticeController extends BaseController {
    
    function __construct (){
        if(!Auth::check()){
            return Redirect::to('login')->with('warning_message', '请首先登录！');
        }
    }

    /**
     * 传记列表
     * @author 齐元举<qiyuanju@51talk.com>
     * @return $this
     */
    public function getIndex() {
        $family_id = Auth::user()->father_family_id;
        $notice_list = FamilyNotice::where('family_id', '=', $family_id)
                               ->where('status', '=', 1)
                               ->paginate(5);
        return View::make('familyNotice.index')->with('notice_list',$notice_list);
    }

    /**
     * 添加
     * @author 齐元举<qiyuanju@51talk.com>
     */
    public function getEdit(){
        $id = intval(Input::get('id'));
        $article = array();
        if($id){
            $family_id =Auth::user()->father_family_id;
            $article = FamilyNotice::whereRaw('id= ? and family_id = ?',array($id, $family_id))->first();
        }
        $article_template_list = ArticleTemplate::all();
        return View::make('familyNotice.edit')
                   ->with('template_list',$article_template_list)
                   ->with('id',$id)
                   ->with('article',$article);
    }

    /**
     * 保存
     * @author 齐元举<qiyuanju@51talk.com>
     */
    public function postDoEdit()
    {
        $id = intval(Input::get('id'));
        if($id){
            $family_notice_modal = FamilyNotice::find($id);
            if($family_notice_modal->family_id != Auth::user()->father_family_id){
                return Redirect::back()->with('warning_message', '您没有权限修改此传记！');
            }
        }else{
            $family_notice_modal = new FamilyNotice();
        }
        $family_notice_modal->family_id = Auth::user()->father_family_id;
        $family_notice_modal->author = Auth::user()->id;
        $family_notice_modal->title = addslashes(trim(Input::get('title')));
        $family_notice_modal->content = addslashes(trim(Input::get('content')));
        $family_notice_modal->last_editor = Auth::user()->id;
        $rs = $family_notice_modal->save();
        if($rs){
            return Redirect::to('familyNotice')->with('success_message', ($id ? '修改' : '添加').'成功！');
        }else{
            return Redirect::to('familyNotice/edit')->with('warning_message', '操作失败！');
        }
    }

    /**
     * 删除
     * @author 齐元举<qiyuanju@51talk.com>
     */
    public function getDrop(){
        $id = intval(Input::get('id'));
        if(empty($id)){
            return Redirect::back()->with('danger_message', '请选择要删除的传记！');
        }
        $family_notice_modal = FamilyNotice::find($id);
        if($family_notice_modal->family_id != Auth::user()->father_family_id){
            return Redirect::back()->with('danger_message', '您没有权限删除此传记！');
        }
        $family_notice_modal->status = 2;
        $rs = $family_notice_modal->save();
        if($rs){
            return Redirect::back()->with('success_message', '删除成功！');
        }else{
            return Redirect::back()->with('warning_message', '删除失败！');
        }
    }
}
