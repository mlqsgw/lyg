<?php
namespace Home\Model;
use Think\Model;
class OrdersModel extends Model{
    protected $tablePrefix = 'lxtx_';

    //��ȡ�û���Ϣ
    public function get_orders_data($u_id){
        return $this->where(array('user_id' => $u_id))->field('id')->find();
    }
}
?>