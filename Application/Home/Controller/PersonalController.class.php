<?php 
namespace Home\Controller;
use Home\Controller\BaseController;
class PersonalController extends BaseController{
	public function accountList(){	

		$builder = I('builder');
		if(empty($builder)){
			$id = I('id');
			$mm = M('user');
			$builder = $mm ->where('id='.$id)->getField('username');
		}

		$m 	   = M('account');
		$count = $m->count();
		$page  = new \Think\Page($count,3);
		$page ->rollpage = '3';
		$page ->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$show = $page->show();
		$this->page = $show;
		$this->num  = $page->firstRow;
		
		$sql = "select 
			b.id as id,
			b.builder as builder,
			b.department as department,
			b.build_time as buildtime,
			b.project_name as project,
			(select a.fee_kind from think_fee_kind as a where b.fee_kind=a.id) as fee,
			b.pre_money as money,
			b.attachment_id as attachment,
			b.content as content,
			b.leading_suggestion as lsuggestion,
			b.director_suggestion as dsuggestion,
			b.status as status
			from think_account b 			
			where b.builder='$builder'			
			order by id limit {$page->firstRow},{$page->listRows}
		";		
		//page 有问题	
		$this->list= $m ->query($sql);	
		$this->display();	
		
	}

	public function accountEdit(){
		$data['id'] = I('id');
		$m = M('account');
		$list = $m ->where($data)->find();
		$this->list = $list;

		$m = M('fee_kind');
		$data = $m ->field('id,fee_kind')->select();
		$this->data = $data;
		$this->display();
	}

	public function editAccount(){
		$data['builder']      = I('builder');
		$data['department']   = I('department');
		$data['project_name'] = I('project_name');
		$data['fee_kind'] 	  = I('fee_kind');
		$data['pre_money']	  = I('pre_money');
		$data['attachment_id']= I('attachment_id');
		$data['content']	  = I('content');
		$data['leading_suggestion'] = I('leading_suggestion');
		$data['director_suggestion']= I('director_suggestion');
		$data['status'] 	  = I('status');

		$m = M('account');
		
		if($m ->where('id='.I('id')) ->save($data))
			$this->success('修改成功');
		else
			$this->error('修改失败');		
	}

	public function accountDelete(){
		$data['id'] = I('id');
		$m 			= M('account');
		if($m->where($data)->delete())
			$this->success('删除成功');
		else
			$this->error('删除失败');
	}	
}