<?php
namespace Home\Model;
use Think\Model;
class DrawModel extends Model{

	//根据用户id获取抽奖表数据
	public function get_draw_by_id($u_id = ""){
		return $this->where(array('u_id' => $u_id))->find();
	}

	//通过id修改抽奖记录表
	public function update_draw_by_id($id = "", $data){
		return  $this->where(array('id' => $id))->data($data)->save();
	}

//	//获取中奖人信息
//	public function get_draw_by_winning_code($winning_code = "") {
//		$where['draw_number'] = array('like',"%$winning_code%");
//		return $this->where($where)->find();
//	}

	//获取抽奖剩余次数
	public function get_draw_surplus_num($u_id = "",$activity_id = ""){
		return $this->where(array('u_id' => $u_id,'activity_id' => $activity_id))->field('id,surplus_num,is_share')->find();
	}

	//修改剩余次数
	public function update_surplus_num($id = "", $data = ""){
		return  $this->where(array('id' => $id))->data($data)->save();
	}

	//获取参与人数
	public function get_playes_num($activity_id = ""){
		return $this->where(array('activity_id' => $activity_id))->field('u_id')->select();
	}

	//根据活动id和用户id获取活动信息
	public function get_draw_code_data($activity_id, $u_id){
		return $this->where(array('activity_id' => $activity_id, 'u_id' => $u_id))->find();
	}
}
?>