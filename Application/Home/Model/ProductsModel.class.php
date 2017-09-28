<?php
namespace Home\Model;
use Think\Model;
class ProductsModel extends Model{
	protected $tablePrefix = 'lxtx_';

	//设置图片大小格式
	public function images_size($products){
		$a = $products;	//图片地址
		$b = substr($a,-3,3);	//截取图片后缀
		$d = '_320.'.$b;			//拼接图片后缀

		if ($b == "png"){
			$e = strstr($a,'.png',TRUE);	//截取图片.png直接的部分
		} else {
			$e = strstr($a,'.jpg',TRUE);	//截取图片.jpg直接的部分
		}
		$images = $e.$d;				//拼接新的图片地址

		return $images;
	}



}
?>