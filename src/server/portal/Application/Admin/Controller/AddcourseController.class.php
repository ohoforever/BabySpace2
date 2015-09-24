<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Admin\Controller;

/**
 * 模型数据管理控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class AddcourseController extends AdminController {



	public function addcourselist($order_id = ''){

		$where = [];
		$baby_name = I('baby_name');
		if(!empty($baby_name)){
			$where['c.baby_name'] = ['like', '%'.(string)$baby_name.'%'];
		}
		$course_name = I('course_name');
		if(!empty($course_name)){
			$where['a.course_name'] = ['like', '%'.(string)$course_name.'%'];
		}

		$school_name = I('school_name');
		if(!empty($school_name)){
			$where['a.school_name'] = ['like', '%'.(string)$school_name.'%'];
		}

		$mobile_num = I('mobile_num');
		if(!empty($mobile_num)){
			$where['b.mobile_num'] = ['like', '%'.(string)$mobile_num.'%'];
		}


		if(!empty($order_id)){
			$where['a.order_id'] = $order_id;
		}

		$prefix = C('DB_PREFIX');
		$model = M()->table($prefix.'kcgl_add_course_order a')
			->join($prefix.'yhgl_child c on a.child_id = c.id')
			->join($prefix.'user b on b.id = c.user_id');



		$this->assign('_list', $this->lists($model,$where,'a.insert_time desc','a.*,c.baby_name,b.mobile_num'));

		$this->meta_title = '报课列表查询';
		$this->display();

	}

	public function query(){

		$mobile_num = I('post.data');

		$user = M("user"); // 实例化User对象
		$condition['mobile_num'] = $mobile_num;
		$userData =$user->where($condition)->find();

		if(!empty($userData)){
			$yhglChild=M("yhgl_child");
			$childData =$yhglChild->where(['user_id'=>$userData['id']])->select();
		}

		$this->ajaxReturn(['userInfo'=>$userData,'childInfo'=>$childData]);
	}

	public function add($id = 0){
		if(IS_POST){
			$this->_addCourse();
		}
		$this->meta_title = '报课';
		$this->assign('active_menu','addcourse/add');
		$this->display();
	}
	public function edit($id = 0){
		$orderid = I('order_id');
		empty($orderid)  &&  $this->error('参数错误');
		if(IS_POST){
			$this->editSave();
		}
		$order = M('kcgl_add_course_order')->where("order_id='$orderid'")->find();
		$baby = M('yhgl_child')->where("id='{$order['child_id']}'")->find();
		$user = M('user')->where("id='{$baby['user_id']}'")->find();
		$this->meta_title = '编辑';
		$this->assign('user',$user);
		$this->assign('baby',$baby);
		$this->assign('order',$order);
		$this->display();
	}
	public function editSave()
	{
		M()->startTrans();
		$order =M("kcgl_add_course_order")->where("order_id='".I('order_id')."'")->find();
		if(empty($order))
		{
			M()->rollback();
			$this->error('订单信息不存在！');
		}
		$userid = $this->saveUser();
		if($userid ===false)
		{
			M()->rollback();
			$this->error('用户信息保存失败！');
		}
		$babyid = $this->saveBaby($userid);
		if($babyid===false)
		{
			M()->rollback();
			$this->error('宝宝信息保存失败！');
		}
		$courseid = $this->saveCourse($babyid);
		if($courseid===false)
		{
			M()->rollback();
			$this->error('课程信息保存失败！');
		}
		$userCourseleft = $this->saveUserCourses($userid,$order);
		if($userCourseleft===false)
		{
			M()->rollback();
			$this->error('用户课程信息保存失败！');
		}
		$memberid = $this->getMemberId($courseid);
		$courseid = $this->saveHistroy(['child_id'=>$babyid,'order_id'=>$courseid,'member_id'=>$memberid,'member_course_count'=>$userCourseleft,'type'=>'UPT']);
		if($courseid===false)
		{
			M()->rollback();
			$this->error('历史信息保存失败！');
		}
		M()->commit();
		$this->success('报课修改成功！',U('addcourse/addcourselist'));
	}

	public function unsubscribe (){
		$orderid = I('id');
		if(IS_POST){
			$this->_addCourse();
		}
		$this->meta_title = '退课';
		$order = M('kcgl_add_course_order')->find($orderid);
		$this->assign('order',$order);
		$this->display();
	}

	private function saveUser()
	{
		$mobile_num= I('post.mobile_num');
		$condition['mobile_num'] = $mobile_num;
		//用户表
		$admin = [];
		$admin['user_name'] = I('post.user_name');
		$admin['city'] = I('post.city');
		$admin['district'] = I('post.district');
		$admin['qq'] = I('post.qq');
		$admin['email'] = I('post.email');
		$admin['update_time'] = time_format();
		$user = M("user"); // 实例化User对象
		$userData =$user->where($condition)->find();
		if(!empty($userData)){
			//修改用户信息
			$ret = $user->where(['mobile_num'=>$mobile_num])->save($admin);
			if($ret!==false)
			{
				$userResult = $userData['id'];
			}else{
				$userResult = false;;
			}

		}else{
			$admin['mobile_num'] = I('post.mobile_num');
			$admin['insert_time'] = time_format();
			//添加用户
			$userResult=$user->add($admin);
		}
		if($userResult){        // 如果主键是自动增长型 成功后返回值就是最新插入的值
			return  $userResult;
		}else{
			return false;
		}
	}
	private function saveMember($userid=0)
	{
		$member = [];
		$member['update_time'] = time_format();
		$member['status'] = 'OK#';
		$hyglMember=M("hygl_member");
		$memberData =$hyglMember->where(['user_id'=>$userid])->find();
		if(!empty($memberData)){
			//修改会员信息
			$ret =$hyglMember->where(['user_id'=>$userid])->save($member);
			//if($ret >0)
			if($ret!==false)
			{
				$memberId= $memberData['id'];
			}else{
				$memberId =false;
			}
		}else{
			//新增会员
			$member['user_id'] = $userid;
			$member['insert_time'] = time_format();
			$memberId=$hyglMember->add($member);
		}
		if($memberId){        // 如果主键是自动增长型 成功后返回值就是最新插入的值
			return  $memberId;
		}else{
			return false;
		}
	}
	private function saveBaby($userid)
	{
		$child=[];
		$child['baby_name'] = I('post.baby_name');
		$child['baby_sex'] = I('post.baby_sex');
		$child['baby_birthday'] = I('post.baby_birthday');
		$childId = I('post.childId');
		$yhglChild=M("yhgl_child");
		$childData =$yhglChild->where(['id'=>$childId])->find();
		if(!empty($childData)){
			$ret =$yhglChild->where(['id'=>$childId])->save($child);
			//if($ret >0)
			if($ret!==false)
			{
				$childId= $childData['id'];
			}else{
				$childId =false;
			}
		}else{
			$child['user_id'] = $userid;
			$childId=$yhglChild->add($child);
		}
		if($childId){
			return  $childId;
		}else{
			return false;
		}
	}

	private function saveCourse($childId)
	{
		$addCourse=[];
		$addCourse['school_name'] = I('post.school_name');
		$addCourse['course_name'] = I('post.course_name');
		$addCourse['course_total'] = I('post.course_total');
		$addCourse['course_amount'] = I('post.course_amount')*100;
		$addCourse['course_price'] = I('post.course_price')*100;
		$addCourse['course_count'] = I('post.course_count');
		$addCourse['given_count'] = I('post.given_count');
		$addCourse['update_time'] = time_format();
		$addCourse['operator'] = is_login();

		$kcglAddCourseOrder=M("kcgl_add_course_order");
		$order = $kcglAddCourseOrder->where("order_id='".I('order_id')."'")->find();
		if(!empty($order)){
			$ret =$kcglAddCourseOrder->where("order_id='".I('order_id')."'")->save($addCourse);
			if($ret!==false)
			{
				return $order['order_id'];
			}else{
				return false;
			}
		}else{
			$addCourse['insert_time'] = time_format();
			$addCourse['child_id']=$childId;
			$addCourse['order_id'] = $this->gen_order_no();
			$addCourse['status']='OK#';
			$addcourseId=$kcglAddCourseOrder->add($addCourse);
		}
		if($addcourseId){
			return $addcourseId;
		}
		return false;
	}
	private function saveUserCourses($userId,$order = array())
	{
		$kcglUserCourses=M("kcgl_user_courses");
		$addCourse=[];
		$userCoursesData =$kcglUserCourses->where(['user_id'=>$userId])->find();
		$course_count = I('post.course_count');
		$given_count = I('post.given_count');
		$addCourse['update_time'] = time_format();
		if(!empty($userCoursesData)){
			if(empty($order))
			{
				$addCourse['course_count'] =$userCoursesData['course_count']+$course_count+$given_count;
				$addCourse['course_left'] = $userCoursesData['course_left']+$course_count+$given_count;

			}else{
				$addCourse['course_count'] =$userCoursesData['course_count']
							     +$course_count+$given_count
							     -$order['given_count']-$order['course_count'];
				$addCourse['course_left'] =$userCoursesData['course_left']
							     +$course_count+$given_count
							     -$order['given_count']-$order['course_count'];
			}
			$ret = $kcglUserCourses->where(['user_id'=>$userId])->save($addCourse);
		}else{
			$addCourse['user_id'] = $userId;
			$addCourse['course_count'] =$course_count+$given_count;
			$addCourse['course_left'] = $course_count+$given_count;
			$addCourse['insert_time'] = time_format();
			$ret = $kcglUserCourses->where(['user_id'=>$userId])->add($addCourse);
		}
		if($ret!==false)
		{
			return $addCourse['course_left'];
		}
		return false;
	}
	private function saveHistroy($data )
	{
		$addCourseHistory=[];
		$addCourseHistory['order_id'] = $data['order_id'];
		$addCourseHistory['member_id'] = $data['member_id'];
		$addCourseHistory['child_id'] = $data['child_id'];
		$addCourseHistory['school_name'] = I('post.school_name');
		$addCourseHistory['course_name'] = I('post.course_name');
		$addCourseHistory['course_total'] = I('post.course_total');
		$addCourseHistory['course_amount'] = I('post.course_amount')*100;
		$addCourseHistory['course_price'] = I('post.course_price')*100;
		$addCourseHistory['course_count'] = I('post.course_count');
		$addCourseHistory['given_course_count'] = I('post.given_count');
		$addCourseHistory['insert_time'] = time_format();
		$addCourseHistory['parent_name'] = I('post.user_name');
		$addCourseHistory['mobile_num'] = I('post.mobile_num');
		$addCourseHistory['baby_name'] = I('post.baby_name');
		$addCourseHistory['baby_sex'] = I('post.baby_sex');
		$addCourseHistory['baby_birthday'] = I('post.baby_birthday');
		$addCourseHistory['member_course_count'] =$data['member_course_count'];
		$addCourseHistory['type'] = isset($data['type'])?$data['type']:'ADD';
		$addCourseHistory['operator'] = is_login();
		$kcglOperCourseHistory=M("kcgl_oper_course_history");
		$addcourseHistoryId=$kcglOperCourseHistory->add($addCourseHistory);
		if($addcourseHistoryId){
			return true;
		}
		return false;
	}
	private function _addCourse(){
		M()->startTrans();
		$userid = $this->saveUser();
		if($userid ===false)
		{
			M()->rollback();
			$this->error('用户信息保存失败！');
		}
		$memberid = $this->saveMember($userid);
		if($babyid===false)
		{
			M()->rollback();
			$this->error('宝宝信息保存失败！');
		}
		$babyid = $this->saveBaby($userid);
		if($babyid===false)
		{
			M()->rollback();
			$this->error('宝宝信息保存失败！');
		}
		$courseid = $this->saveCourse($babyid);
		if($courseid===false)
		{
			M()->rollback();
			$this->error('课程信息保存失败！');
		}
		$userCourseleft = $this->saveUserCourses($userid);
		if($userCourseleft===false)
		{
			M()->rollback();
			$this->error('用户课程信息保存失败！');
		}
		$courseid = $this->saveHistroy(['child_id'=>$babyid,'order_id'=>$courseid,'member_id'=>$memberid,'member_course_count'=>$userCourseleft]);
		if($courseid===false)
		{
			M()->rollback();
			$this->error('历史信息保存失败！');
		}
		M()->commit();
		$this->success('报课成功！',U('addcourse/addcourselist'));
	}
	private function gen_order_no()
	{
		$orderid = 'AC00'.date('YmdHis').rand(1000,9999);
		return $orderid;
	}
	private function getMemberId($userid)
	{
		$order =M("hygl_member")->where("user_id='$userid'")->find();

		return isset($order['id'])?$order['id']:0;
	}
}
