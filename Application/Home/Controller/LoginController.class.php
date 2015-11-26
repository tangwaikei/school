<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller{

	public function index(){
		$this->display();
	}

	public function verify(){
		ob_clean();
		$config = array(
			'fontSize' => 20, 
			'length'   => 5,
			'useNoise' => false //关闭验证码杂点
			);
		$verify = new \Think\Verify($config);
		$verify->entry();
	}

	public function checkLogin(){
		$data['username'] = I('username');
		$data['password'] = I('password');
		$code			  = I('code');

		$verify 		  = new \Think\Verify();
		if($verify->check($code)){
			$m = M('user');
			$result = $m ->where($data)->field('id,username')->find();
			if($result){							
				$id = $result['id'];
				$username = $result['username'];
				session('uid',$id);
				session('username',$username);
				session(C('USER_AUTH_KEY'),true);
				//判断是管理员还是用户				
				if($username == C('SUPERADMIN')){
					session(C('ADMIN_AUTH_KEY'),true);
					$this->redirect('Home/Admin/accountList');							
				}
				else {
					$this->redirect('Home/Personal/accountList',array('builder'=>$username));					
				}
			}		
			else{	
				//没找到该用户			
				$this ->error('请填写正确的用户名和密码！');
			}
		}
		$this->error('验证码错误');
	}

	public function logup(){
		$this ->display();		
	}	

	public function checkLogup(){
		$where['username']= $data['username'] = I('username');
		$data['password'] = I('password');
		$repasswd		  = I('repasswd');		
		$code			  = I('code');
		$session		  = session('?uid');
		$verify 		  = new \Think\Verify();
		if($verify->check($code)){

			$mm			  = M('auth_group_access');
			$m 			  = M('user');
			$id 		  = $m -> where($where) ->getField('id');
			if(empty($id)){
				//没有注册过的用户名
				if($data['password'] === $repasswd){
					$id = $m ->data($data)->add();
					if($id){
						$mm ->create();
						$mm->uid = $id;
						$mm->group_id = 2;
						if($mm ->add()){
							if($session){
								//管理员添加成员
								$this->redirect('User/userList',1,0.5,'添加成功!');
							}
							else $this->success('注册成功',U('Home/Login/index'));
						}
						else{
							$this->error('無法入組！');
						}
					}
					else{
						if($session)
							$this->error('添加成员失敗');
						else
							$this->error('注册失败');	
					}		
				}
				else{
					$this->assign('pwdtip','两次输入的密码不一致');
						if(session('?uid')){
							$this->display('User/userAdd');
							//应该后退一页这样填写资料还在
						}
						else
							$this->display('logup');
				}
			}			
			else{
				$this->assign('nametip','该名字已经注册了');
				if($session)
					$this->display('User/userAdd');
				else
					$this->display('logup');
			}		
		}
		else{
			$this->assign('codetip','验证码错误');
			if($session)
				$this->display('User/userAdd');
			else
				$this->display('logup');
		}
	}

	public function logout(){
		if(session('?uid')){						
			if(session(C('ADMIN_AUTH_KEY')) == true ){			
				session(C('ADMIN_AUTH_KEY'),null);	
				//是管理员		
			}
			session(C('USER_AUTH_KEY'),null);			
			session(null);
			$this->success('成功登出',U('Home/Login/index'));
		}
		else{			
			 $this->error('您已经登出了',U('Home/Login/index'));			
		}			
	}
}