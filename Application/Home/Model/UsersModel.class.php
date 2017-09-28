<?php
namespace Home\Model;
use Think\Model;
class UsersModel extends Model{
	protected $tablePrefix = 'lxtx_';

	//获取用户信息
	public function get_user_data($u_id){
		return $this->table('lxtx_users')->where(array('id' => $u_id))->field('nickname')->find();
	}
}
?>