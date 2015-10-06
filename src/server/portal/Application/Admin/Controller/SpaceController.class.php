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

	private $_uid;

	public function _initialize(){
		$this->_uid= session('user_auth')['uid'];
		parent:: _initialize();
	}

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
		$cid = I('id');
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
		$map['child_id'] = $cid;
		$mature = M("bbkj_baby_mature a")->join('t_ucenter_member t on a.operator=t.id');
		$list   =   $this->lists($mature, $map,'insert_time desc ','a.*,t.username');
		$this->assign('_list', $list);
		$this->assign('cid', $cid);
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
		$child_id = I('cid');
		$this->meta_title ='发布动态';
		$this->assign('child_id', $child_id);
		$this->display();
	}
	public function save()
	{
		$data['title'] = I('post.title');
		empty($data['title']) && $this->error('请输入发布标题');
		$data['content'] = I('post.content');
		empty($data['content']) && $this->error('请输入发布内容');
		$data['redflower_count'] = I('post.redflower_count');
		empty($data['redflower_count']) && $this->error('请选择红花朵数');
		$data['act_time'] = I('post.act_time');
		empty($data['act_time']) && $this->error('请选择活动时间');
		$data['determine'] = I('post.determine');
		empty($data['determine']) && $this->error('请输入老师评价');
		$data['share_title'] = I('post.share_title');
		empty($data['share_title']) && $this->error('请输入分享标题');
		$data['share_content'] = I('post.share_content');
		empty($data['share_content']) && $this->error('请输入分享内容');
		$data['share_img_index'] = I('post.share_img_index');
		empty(I('image'.$data['share_img_index']))&&!empty($data['share_img_index']) && $this->error('选择分享的图片不能为空');
		$data['update_time'] = time_format();
		$data['tag'] = I('post.tag');
		for($i=1;$i<10;$i++)
		{
			//if(!empty(I('post.image'.$i)))
		//	{
				$data['image'.$i] = I('post.image'.$i);
		//	}
		}
		$id = I('post.id');
		$cid = I('post.child_id');
		if(empty($id))
		{
			$data['child_id'] = I('post.child_id');
			$data['insert_time'] = time_format();
			$data['status'] = "OK#";
			$data['operator'] = $this->_uid;
			$ret = M('bbkj_baby_mature')->add($data);
		}else{
			$ret = M('bbkj_baby_mature')->where('id='.$id)->save($data);
		}
		if($ret)
		{
			$this->success('保存成功！',U('space/activelist?id='.$cid));
		}
		$this->error('保存失败！');

	}
	public function activeshow($id=0)
	{
		empty($id) && $this->error('参数错误！');
		$item =  M('bbkj_baby_mature')->field(true)->find($id);
		empty($item) && $this->error('参数错误！');
		$baby =  M('yhgl_child c')->join("t_user u on u.id=user_id")->field('*,user_name')->where('c.id='.$item['child_id'])->find();
		$users = M('ucenter_member')->field('username,id')->select();
		$tmp=[];
		foreach($users as $v)
		{
			$tmp[$v['id']]=$v['username'];
		}
		$this->assign('item', $item);
		$this->assign('baby', $baby);
		$this->assign('users', $tmp);
		$this->meta_title ="查看宝宝动态";
		$this->display();
	}
	public function activedel($id=0,$cid=0)
	{
		empty($id) && $this->error('参数错误！');
		$model =  M('bbkj_baby_mature');
		$model->startTrans(); 
		 M('bbkj_baby_mature_comment')->where("mature_id='.$id'")->delete();
		$res = $model->delete($id);
		if($res !== false){
			    $model->commit();
			    $this->success('删除成功！',U('space/activelist?id='.$cid));
		}
		$model->rollback();
		$this->error('删除失败！');
	}
	public function commentdel($id=0,$mid=0)
	{
		empty($id) && $this->error('参数错误！');
		$model =  M('bbkj_baby_mature_comment');
		$model->startTrans(); 
		$res = $model->delete($id);
		$ret = $model->where('reply_to='.$id)->delete();
		if($res !== false&&$ret !== false){
			    $model->commit();
			    $this->success('删除成功！',U('space/commentlist?id='.$mid));
		}
		$model->rollback();
		$this->error('删除失败！');
	}
	function commentreply()
	{
		$mature_id = I('mid');
		$reply_to = I('id');
		$prefix = C('DB_PREFIX');
		$model = M()->table($prefix.'bbkj_baby_mature_comment a');
		$list = $model->find($reply_to);
		$users = M('user')->select();
		$tech= M('ucenter_member')->select();
		$username = [];
		foreach($users as $v)
		{
			$username[$v['id']] = $v['user_name'];
		}
		$techs= [];
		foreach($tech as $v)
		{
			$techs[$v['id']] = $v['username'];
		}
		$this->assign('item', $list);
		$this->assign('users', $username);
		$this->assign('tech', $techs);
		$this->meta_title = '回复评论';
		$this->display();
	}
	function commentlist()
	{
		$mature_id = I('id');
		$map['mature_id']=$mature_id;
		$prefix = C('DB_PREFIX');
		$model = M()->table($prefix.'bbkj_baby_mature_comment a');
		$list = $model->where($map)->select();
		$users = M('user')->select();
		$tech= M('ucenter_member')->select();
		$username = [];
		foreach($users as $v)
		{
			$username[$v['id']] = $v['user_name'];
		}
		$techs= [];
		foreach($tech as $v)
		{
			$techs[$v['id']] = $v['username'];
		}
		$this->assign('_list', $list);
		$this->assign('users', $username);
		$this->assign('tech', $techs);
		$this->meta_title = '评论列表';
		$this->display();
	}
	function commentsave()
	{
		$data['content'] = I('post.content');
		empty($data['content']) && $this->error('回复内容不能为空');
		$data['insert_time'] = time_format();
		$data['reply_to'] = I('post.reply_to');
		$data['mature_id'] = I('post.mature_id');
		$data['sender_id'] =$this->_uid;
		$data['sender_type'] = 'TECH';
		$ret = M('bbkj_baby_mature_comment')->add($data);
		if($ret)
		{
			$this->success('保存成功！',U('space/activelist?id='.$cid));
		}
		$this->error('保存失败！');
	}

}
