<?php
namespace Home\Controller;
use Home\Controller\BaseController;
class AdminController extends BaseController{
	
	public function accountList(){		
		$m = D('Account');
		$count = $m->count();
		$page = new \Think\Page($count,5);
		$page ->rollpage = '7';
		$page ->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$show = $page->show();
		$this->page = $show;
		$this->num  = $page->firstRow;// 起始行数
		$sql = "select
			b.id as id,
			b.builder as builder,
			b.department as department,
			b.build_time as buildtime,
			b.project_name as project,
			(select a.fee_kind from think_fee_kind as a where b.fee_kind=a.id) as fee,
			b.pre_money as money,
			b.attachment as attachment,
			b.content as content,
			b.leading_suggestion as lsuggestion,
			b.director_suggestion as dsuggestion,
			b.status as status
			from think_account b
			order by id limit {$page->firstRow},{$page->listRows}
		";
		$data = $m ->query($sql);
		$this->data = $data;
		$this->display();
	}

	public function accountAdd(){
		$m = M('fee_kind');
		$data = $m ->field('id,fee_kind') ->select();//二维数组
		$this->data = $data;
		//dump($data);
		$this->display();
	}
	//上传根目录不存在！请尝试手动创建:./Uploads/

	public function addAccount(){
		$data['builder']      = I('builder');
		$data['department']   = I('department');
		$data['project_name'] = I('project_name');	
		$data['fee_kind']	  = I('fee_kind');
		$data['pre_money']	  = I('pre_money');		
		$data['content']	  = I('content');
		$data['leading_suggestion'] = I('leading_suggestion');
		$data['director_suggestion']= I('director_suggestion');
		$data['status'] 	  = I('status');
		$id = '';

		$upload = new \Think\Upload();
		$upload->maxSize = 3145728; //3M
		$upload->exts = array('jpg','gif','png','jpeg', 'txt','doc','docx','xls','xlsx','ppt','ppt', 'pdf');// 设置附件上传类型
		$upload->savePath = './Public/Upload/';
		$upload->saveName = 'time'; 
		$info = $upload->upload();
		if(!$info)
			$this->error($upload->getError());
		else{
			
			$m = M('attachment');			
			$list['file_name'] = $info["attachment"]['savename'];
			$list['original_name'] = $info["attachment"]['name'];
			$list['file_size'] = $info["attachment"]['size'];
			$list['file_type'] = $info["attachment"]['type'];				
			
			if($m->data($list)->add()){							
				$mm = D('Account');
				$data['attachment'] = $list['file_name'];
				if($mm ->updateAccount($id,$data))
					$this->success('上传成功',U('Admin/accountList'));	
				else
					$this->error('上传失败');
			}
			else{
				$this->error('文件上传失败');
			}						
		}						
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
		$data['content']	  = I('content');
		$data['leading_suggestion'] = I('leading_suggestion');
		$data['director_suggestion']= I('director_suggestion');
		$data['status'] 	  = I('status');
		
		$id = I('id');
		$upload = new \Think\Upload();
		$upload->maxSize = 3145728; //3M
		$upload->exts = array('jpg','gif','png','jpeg', 'txt','doc','docx','xls','xlsx','ppt','ppt', 'pdf');// 设置附件上传类型
		$upload->savePath = './Public/Upload/';
		$upload->saveName = 'time'; 
		$info = $upload->upload();
		if(!$info)
			$this->error($upload->getError());
		else{

			$m = M('attachment');			
			$list['file_name'] = $info["attachment"]['savename'];
			$list['original_name'] = $info["attachment"]['name'];
			$list['file_size'] = $info["attachment"]['size'];
			$list['file_type'] = $info["attachment"]['type'];	
			//应该用事务，一个文件存储不成功则无法加入报账中
			if($m->data($list)->add()){							
				$mm = D('Account');
				$data['attachment'] = $list['file_name'];
				if($mm ->updateAccount($id,$data))
					$this->success('上传成功');	
				else
					$this->error('上传失败');
			}
			else{
				$this->error('文件上传失败');
			}						
		}						
	}

	public function accountDelete(){
		$id = I('id');
		
		$m 			= D('Account');		
		
		if($m->deleteAccount($id))
			$this->success('删除成功');
		else
			$this->error('删除失败');		
	}		

	public function newsList(){
		$m  = M('news');
		$count = $m->count();
		$page = new \Think\Page($count,5);
		$page ->rollpage = '7';
		$page ->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$show = $page->show();
		$this->page = $show;
		$this->num  = $page->firstRow;// 起始行数

		$data = $m ->field('id,time,title,click')->select();
		$this ->data = $data;
		$this->display();
	}

	public function newsRead(){
		$data['id'] = I('id');//接收公告的id
		$m  = M('news');
		$this->list = $m ->where($data)->find();
		$this ->display();
	}

	public function newsAdd(){		
		$this->display();
	}

	public function addNews(){
		$data['title']  = I('title');
		$data['content'] = I('content');
		$id   = '';		
		if($_FILES['attachment']['size']==0){
			$m = M('news');
			if($m->data($data)->add())
				$this->redirect('Admin/newsList','',3,'提示:你没有上传文件,新闻添加成功');
			else
				$this->error('添加失败!');
		}

		$upload = new \Think\Upload();
		$upload->maxSize = 3145728; //3M
		$upload->exts = array('jpg','gif','png','jpeg', 'txt','doc','docx','xls','xlsx','ppt','ppt', 'pdf');// 设置附件上传类型
		$upload->savePath = './Public/NewsFile/';
		$upload->saveName = 'time'; 
		$info = $upload->upload();
		$error = $upload->getError();
		if(!$info )
			$this->error($upload->getError());	
		else{
			$m = M('attachment');			
			$list['file_name'] = $info["attachment"]['savename'];
			$list['original_name'] = $info["attachment"]['name'];
			$list['file_size'] = $info["attachment"]['size'];
			$list['file_type'] = $info["attachment"]['type'];	
			//应该用事务，一个文件存储不成功则无法加入报账中
			if($attachment_id = $m->data($list)->add()){							
				$mm = D('News');
				$data['attachment_id'] = $attachment_id;
				if($mm ->updateNews($id,$data))
					$this->success('上传成功','newsList');	
				else
					$this->error('上传失败');
			}
			else{
				$this->error('文件上传失败');
			}			
		}

	}

	public function newsEdit(){
		$m = M('News');
		$id = $data['id']  = I('id');
		//echo $id;
		$sql ="
			select think_news.id as id,
			think_news.title as title,
			think_news.content as content,
			think_attachment.original_name as filename
			from think_news
			left join think_attachment 
			on think_news.attachment_id = think_attachment .id
			where think_news.id={$id}
		";
		$this->data = $m->query($sql);
		//$this->data = $m ->where($data)->find();//一维数组
		//dump($this->data);
		$this->display();
	}

	public function editNews(){
		$data['title']  = I('title');
		$data['content'] = I('content');
		$condition['id'] = I('id');		
		$m = M('news');
		if($_FILES['attachment']['size']==0){
			if($m->where($condition)->data($data)->save())
				$this->redirect('Admin/newsList','',3,'提示:你没有上传文件,新闻修改成功');
			else
				$this->error('修改失败!');
		}

		$upload = new \Think\Upload();
		$upload->maxSize = 3145728; //3M
		$upload->exts = array('jpg','gif','png','jpeg', 'txt','doc','docx','xls','xlsx','ppt','ppt', 'pdf');// 设置附件上传类型
		$upload->savePath = './Public/NewsFile/';
		$upload->saveName = 'time'; 
		$info = $upload->upload();
		$error = $upload->getError();
		if(!$info )
			$this->error($upload->getError());	
		else{
			$where['id'] = $m->where($condition)->getFiled('attachment_id');
			$m = M('attachment');			
			$list['file_name'] = $info["attachment"]['savename'];
			$list['original_name'] = $info["attachment"]['name'];
			$list['file_size'] = $info["attachment"]['size'];
			$list['file_type'] = $info["attachment"]['type'];	
			//应该用事务，一个文件存储不成功则无法加入报账中
			if( $m->where($where)->data($list)->save()){							
				$mm = D('News');
				$data['attachment_id'] = $where['id'];
				if($mm ->updateNews($id,$data))
					$this->success('上传成功','newsList');	
				else
					$this->error('上传失败');
			}
			else{
				$this->error('文件上传失败');
			}			
		}

	}

	public function deleteNews(){
		$data['id']  = I('id');
		$m = M('news');
		$condition['id'] = $m ->where($data)->getFiled('attachment_id');
		$mm = M('attachment');
		if($mm ->where($condition)->delete()){
			if($m->where($data)->delete()){
				$this->success('成功删除','newsList');
			}
			else
				$this->error('删除失败');
		}
		else
			$this->error('删除失败');
	}

	public function activityList(){
		$m = M('activity');
		$count = $m->count();
		$page = new \Think\Page($count,10);
		$page ->rollpage = '7';
		$page ->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$show = $page->show();
		$this->page = $show;
		$this->num  = $page->firstRow;// 起始行数
		$data = $m->field('id,end_time,address,name,rules')->select();
		$this->data = $data;
		$this->display();
		//dump($data);
	}

	public function activityNums(){
		$data['activity_id']=$where['id'] = I('id');
		$m = M('activity');
		$m->where($where)->setInc('num');
		$data['user_id'] =  session('uid');
		$mm = M('activity_user');
		if($mm -> data($data)->add()){
			$this->success('报名成功','activityList');
		}
		else {
			if(!empty($mm->where($data)->find()))
				$this->error('你已经报名');
			else
				$this->error('报名失败,请稍后再操作');
		}

	}

	public function activityRead(){
		$data['id'] = I('id');
		$m = M('activity');
		$this->list = $m ->where($data)->find();
		$this->display();
	}

	public function activityAdd(){
		$this->data =  array(
			array('全体') ,
			array('老师'),
			array('学生')
			);
		//dump( $this->data);
		$this->display();
	}

	public function addActivity(){
		$m = M('activity');
		$data['name'] = I('title');
		$data['start_time'] = I('start_time');
		$data['end_time'] = I('end_time');
		$data['address'] = I('address');
		$data['desc'] = I('content');		
		$arr =  array(
			array('全体') ,
			array('老师'),
			array('学生')
			);
		$index = I('rules');
		$data['rules']  = $arr[$index-1][0];
		if($m->data($data)->add()){
			$this->success('活动添加成功','activityList');
		}
		else
			$this->error('活动添加失败');

	}

	public function activityEdit(){
		$m = M('activity');
		$where['id'] = I('id');
		$this->data = $m ->where($where)->find();
		$this->arr =  array(
			array('全体') ,
			array('老师'),
			array('学生')
			);
		//dump($this->data);
		//修改时下拉条无法显示已选的值
		$this->display();
	}

	public function editActivity(){
		$m = M('activity');
		$data['name'] = I('title');
		$data['start_time'] = I('start_time');
		$data['end_time'] = I('end_time');
		$data['address'] = I('address');
		$data['desc'] = I('content');		
		$arr =  array(
			array('全体') ,
			array('老师'),
			array('学生')
			);
		$index = I('rules');
		$data['rules']  = $arr[$index-1][0];
		if($m->data($data)->add()){
			$this->success('活动修改成功','activityList');
		}
		else
			$this->error('活动修改失败');
	}
	public function deleteActivity(){
		$m = M('activity');
		$where['id'] = I('id');
		if($m ->where($where)->delete()){
			$this->success('删除成功','activityList');
		}
		else
			$this->error('删除失败');
	}
}
