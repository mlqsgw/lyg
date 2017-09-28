<?php
namespace Home\Controller;
use Think\Controller;

require('sdk/carrot.sso.php');

class IndexController extends Controller {

	//获取登录用户信息
	public function if_login(){
		//获取用户登陆信息
		Vendor("sdk.carrot#sso");
		\CarrotSSO::start_session();
		if (!isset($_SESSION['user']) || $_SESSION['user'] == '') {  //如果用户SESSION不存在，尝试SSO登录
			$user_info = \CarrotSSO::auth();

			if (isset($user_info)) {
				$_SESSION['user'] = $user_info;  //分配SESSION
			} else {
				//TODO: 无法通过授权获取用户资料，输出错误页面或重定向到其他不需要登录的页面
				echo '单点登录失败';
				exit;
			}
		}

	}

	//退出
	public function logout() {
		session_destroy();		//清除session
	}

	//首页面活动列表
	public function index(){

		//获取活动列表
		$m_activity = D('activity');
		$m_products = D('products');
        $m_draw = D('draw');

        $u_id = $_SESSION['user']['uid'];

		//获取已结束活动
		$activity_data_end = $m_activity->get_activity_data_end();

		//获取图片
		foreach ($activity_data_end as $key=> $value) {
			$products = $m_products->where(array('id' => $value['product_id']))->find();
			//设置图片大小格式
			$products['cover'] = $m_products->images_size($products['cover']);

			$activity_data_end[$key]["products_images"] = 'http://res.loyoubao.com/uploads/'.$products["cover"];
			$activity_data_end[$key]["product_name"] = $products['product_name'];
            $activity_data_end[$key]["description"] = $products['description'];
			$activity_data_end[$key]["now_code"] = preg_replace('/^0+/','',$value["now_code"]);
		}

		//获取等待开奖中活动
		$activity_data_await = $m_activity->get_activity_data_await();
		//获取图片
		foreach ($activity_data_await as $key=> $value) {
			$products = $m_products->where(array('id' => $value['product_id']))->find();
			//设置图片大小格式
			$products['cover'] = $m_products->images_size($products['cover']);

			$activity_data_await[$key]["products_images"] = 'http://res.loyoubao.com/uploads/'.$products["cover"];
			$activity_data_await[$key]["product_name"] = $products['product_name'];
            $activity_data_await[$key]["description"] = $products['description'];
			$activity_data_await[$key]["now_code"] = preg_replace('/^0+/','',$value["now_code"]);
		}

		//获取明日预告中活动
		$activity_data_notice = $m_activity->get_activity_data_notice();

		//获取图片
		foreach ($activity_data_notice as $key=> $value) {
			$products = $m_products->where(array('id' => $value['product_id']))->find();
			//设置图片大小格式
			$products['cover'] = $m_products->images_size($products['cover']);

			$activity_data_notice[$key]["products_images"] = 'http://res.loyoubao.com/uploads/'.$products["cover"];
			$activity_data_notice[$key]["product_name"] = $products['product_name'];
            $activity_data_notice[$key]["description"] = $products['description'];
            $activity_data_notice[$key]["now_code"] = preg_replace('/^0+/','',$value["now_code"]);
		}

		//获取正在进行中的活动
		$activity_data_going = $m_activity->get_activity_data();
		//获取图片
		foreach ($activity_data_going as $key=> $value) {
			$products = $m_products->where(array('id' => $value['product_id']))->find();
			//设置图片大小格式
			$products['cover'] = $m_products->images_size($products['cover']);

            //立即0元抽按钮状态
            $draw_number_data = $m_draw->where(array('activity_id' => $value['id'],'u_id' => $u_id))->find();
            $draw_number_length = strlen($draw_number_data['draw_number']);

            if ($draw_number_length < 10) {
                $draw_number_status = 1;
            } elseif($draw_number_length == 10){
                $draw_number_status = 2;

            } elseif($draw_number_length > 10){
                $draw_number_status = 3;
            }

			$activity_data_going[$key]["products_images"] = 'http://res.loyoubao.com/uploads/'.$products["cover"];
			$activity_data_going[$key]["product_name"] = $products['product_name'];
			$activity_data_going[$key]["description"] = $products['description'];
            $activity_data_going[$key]["draw_number_status"] = $draw_number_status;
			$activity_data_going[$key]["now_code"] = preg_replace('/^0+/','',$value["now_code"]);
		}

		foreach ($activity_data_await as $k=>$v){
			$activity_data_await_time[$k] = $v['winning_time'];
		}
		$str_await_time = implode(',',$activity_data_await_time);

		foreach ($activity_data_notice as $k=>$v){
			$activity_data_start_time[$k] = $v['start_time'];
		}
		$str_start_time = implode(',',$activity_data_start_time);

		foreach ($activity_data_going as $k=>$v){
			$activity_data_end_time[$k] = $v['end_time'];
		}
		$str_end_time = implode(',',$activity_data_end_time);

		$this->assign("activity_data", $activity_data_end);
		$this->assign("activity_data_await", $activity_data_await);
		$this->assign("activity_data_notice", $activity_data_notice);
		$this->assign("activity_data_going", $activity_data_going);

		$this->assign("str_start_time", $str_start_time);
		$this->assign("str_await_time", $str_await_time);
		$this->assign("str_end_time", $str_end_time);
		$this->assign("now_time", time());
		$this->assign("date_time", strtotime(date("Y-m-d 23:59:59")));
        $this->assign("u_id", $u_id);

		$this->display();

	}

	//下拉加载
	public function getMore(){
		//获取最后一个id
		if (!empty($_GET['lastid'])){
			$map['id'] = array('lt',$_GET['lastid']);
			$now_time = time();
			$map['winning_time'] = array('lt', $now_time);
			$map['is_putaway'] = 1;

			$data = D('activity')->where($map)->order('id desc')->limit(5)->select();

			foreach ($data as $key=> $value) {
				$products = D('products')->where(array('id' => $value['product_id']))->find();
				//设置图片大小格式
				$products['cover'] = D('products')->images_size($products['cover']);
				$data[$key]["images"] = 'http://res.loyoubao.com/uploads/'.$products["cover"];
				$data[$key]["product_name"] = $products['product_name'];
				$data[$key]["description"] = $products['description'];
				$data[$key]["now_code"] = preg_replace('/^0+/','',$value["now_code"]);
			}
			$this->ajaxReturn($data);
		}
	}

	//活动详情页
	public function purchase(){

		$this->if_login();
		$u_id = $_SESSION['user']['uid'];
		$activity_id = $_GET['activity_id'];

		//获取活动详情
		$m_activity = D('activity');
		$activity_data = $m_activity->get_activity_by_id($activity_id);
		$products = D('products')->where(array('id' => $activity_data['product_id']))->find();

		//设置图片大小格式
		$m_products = D('products');
		$products["images"] = $m_products->images_size($products['cover']);

		$activity_data["images"] = 'http://res.loyoubao.com/uploads/'.$products["images"];
		$activity_data["product_name"] = $products["product_name"];
		$activity_data["description"] = $products["description"];

		$activity_data["now_code"] = preg_replace('/^0+/','',$activity_data["now_code"]);

		//获取中奖用户昵称
		$m_users = D('users');
		$user_nickname = $m_users->get_user_data($activity_data['u_id']);

		//判断是否是中奖用户
		if ($u_id == $activity_data['u_id'] && isset($u_id)){
			$user_draw_status = 1; //是中奖用户
		} else {
			$user_draw_status = 0; //不是中奖用户
		}

		//获取该期用户抽奖信息
		$m_record = D('record');
		$record_data = $m_record->get_record_by_uid($u_id);

		//获取用户是否可以抽奖
		$m_draw = D('draw');
		$draw_data = $m_draw->get_draw_surplus_num($u_id,$activity_id);
		$draw_surplus_num = $draw_data['surplus_num'];

		$record_data = json_decode($record_data["content"], true);

		//该期中奖号
		$record_draw = $record_data[$activity_id];

		$this->assign("user_draw_status",$user_draw_status);  //用户中奖状态
		$this->assign("products",$products);
		$this->assign("activity_data", $activity_data);
		$this->assign("record_draw", $record_draw);
		$this->assign("nickname", $user_nickname);
		$this->assign("activity_id", $activity_id);
		$this->assign("draw_surplus_num", $draw_surplus_num);
		$this->assign("now_time", time());
		$this->display();
	}


	//生成抽奖码
	public function get_now_code() {
		$this->if_login();
		$u_id = $_SESSION['user']['uid'];

		$is_robot = 0;
		$activity_id = $_GET['activity_id'];

		//判断是否绑定过手机号
		$has_phone = file_get_contents("http://sso.loyoubao.com/has_phone?uid=$u_id");

		if ($has_phone != 1){
			$result = array(
				"status" => false,
				"has_phone" => 1
			);

			$this->ajaxReturn($result);exit;
		}

		$m_activity = D('activity');

		//通过活动id获取活动数据
		$activity_data = $m_activity->get_activity_by_id($activity_id);

		if ($activity_data) {
			//生成抽奖码
			$draw_number = $activity_data['now_code'];
			$draw_number += 1;
			//自动补全0
			$draw_number = $this->supplement_zero($draw_number);

			//根据用户id和活动id获取抽奖表数据
			$m_draw = D('draw');
			$draw_data = $m_draw->get_draw_code_data($activity_id,$u_id);

			if ($draw_data &&  $draw_data["surplus_num"] > 0) {

				//抽奖记录表--保存抽奖码、剩余次数减1
				$draw_draw_number = $draw_data["draw_number"] . "[" . $draw_number . "]";

				$draw_data_update = array(
					"draw_number" => $draw_draw_number,
					"surplus_num" => $draw_data["surplus_num"] -1,
				);


				$result = $m_draw->update_draw_by_id($draw_data['id'],  $draw_data_update);


				//修改活动表当期抽奖码和参与人次
				if ($result) {
					$activity_data_update["now_code"] = $draw_number;
					$activity_data_update["players_num"] = $activity_data["players_num"] +1;
					$result = $m_activity->update_activity_by_id($activity_id, $activity_data_update);
					if($result){
						$result = array(
							"status" => true,
							"draw_number" => $draw_number
						);
					}
				}
			} elseif ($draw_data && $draw_data["surplus_num"] <= 0) {
				$result = array(
					"status" => false,
					"message" => "已抽过奖"
				);
			} else {
				$draw_draw_number = "[" . $draw_number . "]";
				$draw_data_add = array(
					"u_id" => $u_id,
					"activity_id" => $activity_id,
					"draw_number" => $draw_draw_number,
					"surplus_num" => 0,
					"create_time" => time(),
					"is_robot" => $is_robot
				);

				$result = M('draw')->data($draw_data_add)->add();
				//修改活动表当前抽奖码和参与人数
				if ($result) {
					//$players_num = count($m_draw->get_playes_num($activity_id));
					$activity_data["players_num"] = $activity_data["players_num"] +1;
					$activity_data["now_code"] = $draw_number;
					$result = $m_activity->update_activity_by_id($activity_id, $activity_data);

					if($result){
						$result = array(
							"status" => true,
							"draw_number" => $draw_number
						);
					}
				}
			}

			if ($result["status"] == true) {
				//我的抽奖码--保存抽奖码
				//判断是否抽过奖
				$m_record = D('record');
				$record_data = $m_record->get_record_by_uid($u_id);

				if ($record_data) {
					$record_content_activity_id_array = $record_data["content"];
					$record_content_activity_id_array = json_decode($record_content_activity_id_array, true);
					$is_activity_id = false;

					foreach($record_content_activity_id_array as $key=> $value) {
						//判断是否抽过该期中奖码
						if ($activity_id == $key) {
							$record_content_activity_id_array[$key][] = $draw_number;
							$data = array(
								'content' => json_encode($record_content_activity_id_array)
							);
							$result_record = $m_record->update_record_by_uid($u_id, $data);
							$is_activity_id = true;
							break;
						}
					}

					if (!$is_activity_id) {
						$record_content_activity_id_array[$activity_id][] = $draw_number;
						$record_data_array = array(
							'content' => json_encode($record_content_activity_id_array)
						);

						$result_record = $m_record->update_record_by_uid($u_id, $record_data_array);

					}

				} else {
					$record_content_array[$activity_id][] = $draw_number;
					$record_data_array = array(
						'u_id' => $u_id,
						'content' => json_encode($record_content_array),
						'create_time' => time(),
						'is_robot' => $is_robot
					);
					$result_record = M('record')->data($record_data_array)->add();
				}
			}

		} else {
			$result = array(
				"status" => false,
				"message" => "未找到该活动"
			);
		}

		$this->ajaxReturn($result);
	}
	//自动补全0
	public function supplement_zero($draw_number) {
		$bit = 8;
		$num_len = strlen($draw_number);  //计算编码长度strlen()
		$zero = "";
		for ($i = $num_len; $i<$bit; $i++) {
			$zero .= "0";
		}
		$draw_number = $zero.$draw_number;
		return $draw_number;
	}

	//转发抽奖的剩余次数加1
	public function transpond() {
		$this->if_login();
		$u_id = $_SESSION['user']['uid'];

		$activity_id = $_GET['activity_id'];
		$m_draw = D('draw');
		$draw_data = $m_draw->get_draw_surplus_num($u_id,$activity_id);
		if ($draw_data && $draw_data["is_share"] == 0) {
			$data["surplus_num"] = $draw_data["surplus_num"] + 1;
			$data["is_share"] = 1;
			$result = $m_draw->update_surplus_num($draw_data['id'], $data);
			if ($result) {
				$data["status"] = true;
				$data["message"] = "";
			}

		} elseif($draw_data && $draw_data["is_share"] == 1) {
			$data["status"] = true;
			$data["message"] = "已分享过";
		} else {
			$data["status"] = true;
			$draw_data_add = array(
				"u_id" => $u_id,
				"activity_id" => $activity_id,
				"draw_number" => '',
				"surplus_num" => 2,
				"create_time" => time(),
				"is_share" => 1,
				"is_robot" => 0
			);
			$result = M('draw')->data($draw_data_add)->add();
		}
		$this->ajaxReturn($data);
	}

	//判断是否可以抽奖
	public function is_draw(){
		$this->if_login();
		$u_id = $_SESSION['user']['uid'];

		$activity_id = $_GET['activity_id'];
		$m_draw = D('draw');
		$draw_data = $m_draw->get_draw_surplus_num($u_id,$activity_id);
		$draw_surplus_num = $draw_data['surplus_num'];

		$this->ajaxReturn($draw_surplus_num);
	}

	//判断是否开奖成功
	public function draw_status() {
		$this->if_login();

		$id = $_GET['id']; //获取活动id
		$m_activity = D('activity');
		$activity_data = $m_activity->get_activity_by_id($id);

		if ($activity_data['u_id']) {
			$result["status"] = true;
		} else {
			$result["status"] = false;
		}

		$this->ajaxReturn($result);
	}

}