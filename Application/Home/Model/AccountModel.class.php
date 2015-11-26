<?php
namespace Home\Model;
use Think\Model;
class AccountModel extends Model{
	public function updateAccount($id='',$data){
		if(empty($id)){
			//添加报账
			return $this->data($data)->add();
		}
		//更新报账
		$where['id'] = $id;
		return $this->where($where)->save($data);
	}

	public function deleteAccount($id){
		if(empty($id))
			return false;
		//检测数据
		else{
			$where['id'] = $id;
			$data['file_name'] = $this->where($where)->getField('attachment');
			$result = $this->where($where) ->delete();
			if($result){
				$m = M('attachment');
				return $m ->where($data)->delete();
			}
			else
				return false;
		}
	}

	/*
	附件略缩图，各种字段验证
	之后还要进行缓存，包括数据库的缓存，mysql的优化
	*/
}

