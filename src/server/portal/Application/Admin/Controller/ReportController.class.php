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
class  ReportController extends AdminController {

    /**
     * 行为日志列表
     * @author huajie <banhuajie@163.com>
     */


	public function _initialize(){
		parent:: _initialize();
	}
	public function candidate(){
		$day = date('Y-m-01');
		//$list   =   M('tjfx_candidate_add_daily')->where(['stat_date'=>['EGT',$day]])->select();
		$list =$this->lists('tjfx_candidate_add_daily',['stat_date'=>['EGT',$day]] ,'stat_date desc group by stat_date');
		$this->assign('_list', $list);
		$this->meta_title = '新增线上非会员统计';
		$this->display();
	}
	public function share(){
		$day = date('Y-m-01');
		$m  = M('tjfx_share_stat_hourly')->group('stat_date');
		$list =$this->lists($m ,['stat_date'=>['EGT',$day]],'stat_date desc',"sum(baby_wonderful_share_count) as baby_wonderful_share_count,sum(baby_mature_share_count) as baby_mature_share_count,sum(baby_appointment_share_count) as baby_appointment_share_count,stat_date");
		$this->assign('_list', $list);
		$this->meta_title = '分享统计';
		$this->display();
	}
	public function course(){
		$day = date('Y-m-01');
		//$list   =   M('t_tjfx_course_spend_stat_daily')->where(['stat_date'=>['EGT',$day]])->select();
		$list =$this->lists('tjfx_course_spend_stat_daily' ,['stat_date'=>['EGT',$day]],' stat_date desc');
		$this->assign('data', $list);
		$this->meta_title = '分享统计';
		$this->display();
	}
	function interlocution()
	{
		$day = date('Y-m-01');
		$m  = M('tjfx_interlocution_hourly')->group('stat_date');
		$list =$this->lists($m ,['stat_date'=>['EGT',$day]],'stat_date desc',"sum(question_count) as question_count,sum(answer_count) as answer_count ,stat_date");
		$this->assign('_list', $list);
		$this->meta_title = '宝宝问答访问统计';
		$this->display();
	}
}
