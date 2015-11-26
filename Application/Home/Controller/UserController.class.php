<?php 
namespace Home\Controller;
use Home\Controller\BaseController;
class UserController extends BaseController{
	public function userList(){
		$m = M('user')	;
		$count = $m->count();
		$page = new \Think\Page($count,10);
		$page ->rollpage = '7';
		$page ->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$show = $page->show();
		$this->page = $show;
		$this->num  = $page->firstRow;

		$sql  = "select 
				b.id as id,
				b.username as username,
				b.nickname as nickname,
				(select count(a.builder) from think_account a where a.builder=b.username) as accountnum
				from think_user b
				order by id limit {$page->firstRow},{$page->listRows}
		";
		$this->data = $m->query($sql);	
		$this->display();
		
	}

	public function userEdit(){		
		$where['id'] = I('id');
		if(empty(I('id'))){
			$where['id'] = session('uid');
		}

		$m 			 = M('user');
		$this->list  = $m ->where($where)->find();
		$this->display();
				
	}

	public function editUser(){		
		$m 			 = M('user');
		$where['id'] = I('id');
		$data['username'] = I('username');
		$data['nickname'] = I('nickname');
		$result 	 = $m ->where($where)->save($data);
		if($result)
			$this->success('修改成功',U('Home/User/userList'));
		else
			$this->error('修改失败');
		}
	
	public function userDelete(){
		$id = $where['id'] = I('id');
		if(session('uid') == $id){
			$this->error("无法删除");
		}//不能删除自己
		$m 			 = M('user');
		$U['builder']= $m ->where($where)->getField('username');
		$mm 		 = M('account');
		if($mm->where($U)->delete() && $m->where($where)->delete())
			$this->success('删除成功',U('Home/User/userList'));
		else
			$this->error('删除失败',U('Home/User/userList'));
	}

	public function editPwd(){
		$where['id'] = I('id');
		$where['password'] = I('currentpwd');
		$m = M('user');
		if($m ->where($where)->getField('id')){
			//找到
			$newPwd = I('pwd');
			$samPwd = I('rpwd');
			if($newPwd === $samPwd){
				$data['password'] = I('pwd');
				$result = $m ->where('id='.$where['id'])->save($data);
				if($result)
					$this->redirect('Home/User/userEdit',array('id'=>I('id')),1,'修改密碼成功');
				else
					$this->error('修改密码失败');
			}
			else
				$this->pwdtip = "你输入的两次密码错误";
		}
		else
			$this->currenttip = "你输入的当前密码不符";
		$this->display('userEdit');
	}
}