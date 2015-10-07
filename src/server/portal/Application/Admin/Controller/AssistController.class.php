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
class AssistController extends AdminController {

    /**
     * 行为日志列表
     * @author huajie <banhuajie@163.com>
     */
	private $_size;

	private $_uid;

	public function _initialize(){
		$this->_size = 30;
		$this->_uid= session('user_auth')['uid'];
		parent:: _initialize();
	}
	public function index(){
		if(!empty(I('parent_name')))
		{
			$map['parent_name']= array('like', '%'.I('parent_name').'%');
		}
		if(!empty(I('baby_sex')))
		{
			$map['baby_sex']= I('baby_sex');
		}
		$map['status']    =   'CRT';
		$map['current_assistant_id'] = $this->_uid;   
		$list =M('khkf_candidate')->where($map)->limit($this->_size)->select();
		$this->assign('_list', $list);
		$this->meta_title = '待开发客户列表';
		$this->display();
	}

	/**
	 *编辑 
	 */
	public function show($id = 0){
		empty($id) && $this->error('参数错误！');
		$map = ['id'=>$id,'current_assistant_id'=>$this->_uid,'status'=>'CRT'];
		$info = M('khkf_candidate')->field(true)->where($map)->find();
		empty($info) && $this->error('请求的数据不存在！');
		$assi = M('ucenter_member')->field('id,username')->select();
		$tmp = [];
		foreach($assi as $v)
		{
			$tmp[$v['id']]= $v['username'];
		}
		$this->assign('user', $tmp);
		$this->assign('item',$info);
		$this->meta_title = '查看客户信息';
		$this->display();
	}

	public function mark($id=0){
		empty($id) && $this->error('参数错误！');
		$map = ['id'=>$id,'current_assistant_id'=>$this->_uid,'status'=>'CRT'];
		$info = M('khkf_candidate')->field(true)->where($map)->find();
		empty($info) && $this->error('请求的数据不存在！');
		$list = M('khkf_candidate_evaluation')->field(true)->where("candidate_id='$id'")->select();
		$assi = M('ucenter_member')->field('id,username')->select();
		$tmp = [];
		foreach($assi as $v)
		{
			$tmp[$v['id']]= $v['username'];
		}
		$this->assign('user', $tmp);
		$this->assign('item',$info);
		$this->assign('list',$list);
		$this->meta_title = '标注客户';
		$this->display('info');
	}

    public function save()
    {
	    $data['candidate_id']= I('post.id');
	    $id = I('post.id');
	    $data['level']= I('post.level');
	    $data['star']= I('post.star');
	    $data['evaluation']= I('post.evaluation');
	    $data['assistant_id']= $this->_uid;
	    $data['insert_time']= time_format();
	    $model = M('khkf_candidate_evaluation');
	    $model->startTrans(); 
	    $res = $model->add($data);
	    if($res !== false){
		    $rest =  M('khkf_candidate')->where("id='$id'")->save(['level'=>$data['level'],'star'=>$data['star'],'update_time'=>time_format()]);
		    if($rest!==false)
		    {
			    $model->commit();
			    $this->success('保存成功！',U('Assist/index'));
		    }
		    $model->rollback(); 
		    $this->error('保存失败！');
	    }else {
		    $model->rollback(); 
		    $this->error('保存失败！');
	    }
    }
}
