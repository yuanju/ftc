<?php

class FamilyController extends BaseController {
    
    function __construct (){
        if(!Auth::check()){
            return Redirect::to('login')->with('warning_message', '请首先登录！');
        }
    }

	public function index()
	{
//        $family_list = Family::where('id', '>', '0')->paginate(2);
//		return View::make('family')->with('family_list', $family_list);
//        var_dump($family_list);
//        exit;
        return View::make('family.index');
	}
    

    public function add(){
//        App::abort(404);
//        $family = new Family();
//        $family->name = '宋家';
//        $family->family_name = '宋';
//        $rs = $family->save();
//        $user = Family::firstOrCreate(array('name' => 'John'));
//        $user = User::create(array('name' => 'John'));
//        var_dump($user);
    }
}
