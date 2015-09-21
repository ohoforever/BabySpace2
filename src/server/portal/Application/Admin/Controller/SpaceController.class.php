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
class SpaceController extends AdminController {

    /**
     * 行为日志列表
     * @author huajie <banhuajie@163.com>
     */


	public function index(){
		if(!empty(I('baby_name')))
		{
			$map['baby_name']= array('like', '%'.I('baby_name').'%');
		}
		if(!empty(I('baby_sex')))
		{
			$map['baby_sex']= I("baby_sex");
		}
		$prefix = C('DB_PREFIX');
		$model = M()->table($prefix.'yhgl_child a')
			->join($prefix.'user b on a.user_id= b.id');;
		$list   =   $this->lists($model, $map,null,'a.*,user_name ,mobile_num');
		$this->assign('_list', $list);
		$this->meta_title = '宝宝列表';
		$this->display();
	}
	public function activelist(){
		if(!empty(I('title')))
		{
			$map['title']= array('like', '%'.I('title').'%');
		}
		if(!empty(I('tag')))
		{
			$map['tag']= array('like', '%'.I('tag').'%');
		}
		if(!empty(I('stime')))
		{
			$map['insert_time']= array('>=', I('stime')." 00:00:00");
		}
		if(!empty(I('etime')))
		{
			$map['insert_time']= array('<=', I('etime').' 23:59:59');
		}
		$list   =   $this->lists('bbkj_baby_mature', $map);
		$this->assign('_list', $list);
		$this->meta_title = '宝宝动态列表';
		$this->display();
	}


	public function activeedit($id=0)
	{
		empty($id) && $this->error('参数错误！');
		$item =  M('bbkj_baby_mature')->field(true)->find($id);;
		$this->assign('item', $item);
		$this->meta_title ='编辑动态';
		$this->display();
	}
	public function activeadd()
	{
		$this->meta_title ='发布动态';
		$this->display();
	}
	public function activeshow($id=0)
	{
		empty($id) && $this->error('参数错误！');
		$item =  M('bbkj_baby_mature')->field(true)->find($id);
		empty($item) && $this->error('参数错误！');
		$baby =  M('yhgl_child c')->join("t_user u on u.id=user_id")->field('*,user_name')->where('c.id='.$item['child_id'])->find();
		$this->assign('item', $item);
		$this->assign('baby', $baby);
		$this->meta_title ="查看宝宝动态";
		$this->display();
	}
	public function activedel($id=0)
	{
		empty($id) && $this->error('参数错误！');
		$model =  M('bbkj_baby_mature');
		$model->startTrans(); 
		 M('bbkj_baby_mature_comment')->where("mature_id='.$id'")->delete();
		$res = $model->delete($id);
		if($res !== false){
			    $model->commit();
			    $this->success('删除成功！',U('space/index'));
		}
		$model->rollback();
		$this->error('删除失败！');
	}
}
