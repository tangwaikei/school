<?php
namespace Home\Controller;
use Home\Controller\BaseController;
class IndexController extends BaseController {	

    public function index(){
    	echo ('首页');
    }

    public function admin(){
    	
    }

    public function user(){
    	echo ('普通用户！');
    }
}