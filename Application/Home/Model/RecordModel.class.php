<?php
namespace Home\Model;
use Think\Model;
class RecordModel extends Model{

	//获取抽奖人信息
	public function get_record_by_uid($u_id = ""){
		return $this->where(array('u_id' => $u_id))->find();
	}

	//根据用户id修改中奖码信息
	public function update_record_by_uid($u_id = "", $data = "") {
		return  $this->where(array('u_id' => $u_id))->data($data)->save();
	}

	//获取抽奖人数
	public function get_players_num(){
		return $this->where(array('is_del' => 0))->field('u_id')->select();
	}
}
?>