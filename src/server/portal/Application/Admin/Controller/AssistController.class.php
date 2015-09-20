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
		$info = M('khkf_candidate')->field(true)->find($map);
		empty($info) && $this->error('请求的数据不存在！');
		$this->assign('item',$info);
		$this->meta_title = '查看客户信息';
		$this->display();
	}

	public function mark($id=0){
		empty($id) && $this->error('参数错误！');
		$map = ['id'=>$id,'current_assistant_id'=>$this->_uid,'status'=>'CRT'];
		$info = M('khkf_candidate')->field(true)->find($map);
		empty($info) && $this->error('请求的数据不存在！');
		$list = M('khkf_candidate_evaluation')->field(true)->where($map)->select();
		$this->assign('item',$info);
		$this->assign('list',$list);
		$this->meta_title = '标注客户';
		$this->display('info');
	}

	public function marked(){
        $data['parent_name'] = I('post.parent_name');
        empty($data['parent_name']) && $this->error('请输入家长姓名');
        $data['mobile_num'] = I('post.mobile_num');
        empty($data['mobile_num']) && $this->error('请输入家长电话号码');
        $data['baby_name'] = I('post.baby_name');
        empty($data['baby_name']) && $this->error('请输入宝贝姓名');
        $data['baby_sex'] = I('post.baby_sex');
        empty($data['baby_sex']) && $this->error('请输入宝贝性别');
        $data['star'] = I('post.star');
        $data['star'] =='' && $this->error('请输入候选人星数');
        $data['district'] = I('post.district');
        empty($data['district']) && $this->error('请输入家庭所在城市区域');
        $data['city'] = I('post.city');
        empty($data['city']) && $this->error('请输入家庭所有城市');
        $data['baby_birthday']= I('post.baby_birthday');
        empty($data['baby_birthday']) && $this->error('请输入宝宝出生年月');
        $data['level']= I('post.level');
        $id = I('post.id');
	if(empty($id))
	{
		$data['insert_time'] = date("Y-m-d H:i:s");
		$data['status'] = "CRT";
		$res = M('khkf_candidate')->add($data);
	}else{
		$data['update_time'] = date("Y-m-d H:i:s");
		$res = M('khkf_candidate')->where('id='.$id)->save($data);
	} 
        if($res !== false){
            $this->success('保存成功！',U('custommanage/index'));
        }else {
            $this->error('保存失败！');
        }
    }

    public function allocatesave()
    {
	    $current_assistant_id = I('post.current_assistant_id');
	    $id = I('post.id');
	    empty($id) && $this->error('参数错误');
	    $model = M('khkf_candidate');
	    $model->startTrans(); 
	    $res = $model->where('id='.$id)->save(['current_assistant_id'=>$current_assistant_id,'update_time'=>date("Y-m-d H:i:s")]);
	    if($res !== false){
		    $rest =  M('khkf_candidate_develop')->add(['candidate_id'=>$id,'assistant_id'=>$current_assistant_id,'insert_time'=>date("Y-m-d H:i:s")]);
		    if($rets!==false)
		    {
			    $model->commit();
			    $this->success('保存成功！',U('custommanage/allocate'));
		    }
		    $model->rollback(); 
		    $this->error('保存失败！');
	    }else {
		    $model->rollback(); 
		    $this->error('保存失败！');
	    }
    }
}
