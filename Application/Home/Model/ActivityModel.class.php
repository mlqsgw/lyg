<?php
namespace Home\Model;
use Think\Model;
class ActivityModel extends Model{

	//通过活动id获取活动数据
	public function get_activity_by_id($id = ""){
		return $this->where(array('id' => $id))->find();
	}

	//修改活动表
	public function update_activity_by_id($id = "", $data= ""){
		return  $this->where(array('id' => $id))->data($data)->save();
	}

//	//获取活动信息
//	public function get_new_code_by_id($id = ""){
//		return $this->where(array('id' => $id))->find();
//	}

	//活动首页获取正在进行中活动信息
	public function get_activity_data(){
		$now_time = time();
		$where["start_time"] = array('lt', $now_time);
		$where["end_time"] = array('gt', $now_time);
		$where["is_putaway"] = 1;

		return $this->where($where)->order('end_time asc')->select();
	}

	//活动首页获取明日预告活动信息
	public function get_activity_data_notice(){
		$now_time = time();
		$where["start_time"] = array('gt', $now_time);
		$where["is_putaway"] = 1;

		return $this->where($where)->order('start_time asc')->select();
	}

	//活动首页等待开奖的活动信息
	public function get_activity_data_await(){
		$now_time = time();
		$where["winning_time"] = array('gt', $now_time);
		$where["end_time"] = array('lt', $now_time);
		$where["is_putaway"] = 1;

		return $this->where($where)->order('winning_time asc')->select();
	}

	//活动首页活动已结束的活动信息
	public function get_activity_data_end(){
		$now_time = time();
		$where["winning_time"] = array('lt', $now_time);
		$where["is_putaway"] = 1;

		return $this->where($where)->order('id desc')->limit(5)->select();
	}





}
?>