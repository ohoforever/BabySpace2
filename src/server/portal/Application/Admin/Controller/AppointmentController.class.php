<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;

/**
 * 行为控制器
 * @author huajie <banhuajie@163.com>
 */
class AppointmentController extends AdminController {

    /**
     * 行为日志列表
     * @author huajie <banhuajie@163.com>
     */


	public function _initialize(){
		parent:: _initialize();
	}
	public function index(){
		if(!empty(I('city')))
		{
			$map['city']= array('like', '%'.I('city').'%');
		}
		if(!empty(I('district')))
		{
			$map['district']= array('like', '%'.I('district').'%');
		}
		if(!empty(I('stime')))
		{
			$map['insert_time']= array('>=', I('stime')." 00:00:00");
		}
		if(!empty(I('etime')))
		{
			$map['insert_time']= array('<=', I('etime').' 23:59:59');
		}
		$list   =   $this->lists('khkf_appointment', $map);
		$this->assign('_list', $list);
		$this->meta_title = '预约列表';
		$this->display();
	}

	/**
	 *编辑 
	 */

	public function createqr(){
		$this->meta_title = '生成预约二维码';
		$this->display();
	}
	public function createQRfile(){
		Vendor('phpqrcode');
		$url = "http://baidu.com";
		header('Content-type: application/png'); 
		header('Content-Disposition: attachment; filename="test.png"'); 
		echo \QRcode::png($url,false,QR_ECLEVEL_L,9);
	}
}
