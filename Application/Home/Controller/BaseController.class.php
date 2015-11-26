<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller{

	public function _initialize(){
		$rule = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;//strtolower();
		$auth = new \Think\Auth();		

		if(empty($_SESSION['uid']))
			$this->redirect('Home/Login/index');//没有session就调到登录的界面

		if(!$auth->check($rule,session('uid'))){
			exit('没有权限');
		}

	}
}