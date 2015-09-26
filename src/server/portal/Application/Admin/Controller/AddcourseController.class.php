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
            $data['mobile_num'] = I('post.mobile_num');
            empty($data['mobile_num']) && $this->error('请输入手机号码');
            if(!is_numeric($data['mobile_num'])){
                $this->error('请输入正确的手机号码');
            }
            $data['baby_name'] = I('post.baby_name');
            empty($data['baby_name']) && $this->error('请输入宝宝姓名');
            $data['baby_birthday'] = I('post.baby_birthday');
            empty($data['baby_birthday']) && $this->error('请输入宝宝生日');

            $data['school_name'] = I('post.school_name');
            empty($data['school_name']) && $this->error('请输入学校名称');
            $data['course_name'] = I('post.course_name');
            empty($data['baby_birthday']) && $this->error('请输入课程名称');

            $data['course_total'] = I('post.course_total');
            empty($data['course_total']) && $this->error('请输入课程课时');
            $data['course_amount'] = I('post.course_amount');
            empty($data['course_amount']) && $this->error('请输入买课费用');

            $data['course_price'] = I('post.course_price');
            empty($data['course_price']) && $this->error('请输入课程单价');
            $data['course_count'] = I('post.course_count');
            empty($data['course_count']) && $this->error('请输入购买课时');
            $data['given_count'] = I('post.given_count');
            empty($data['given_count']) && $this->error('请输入赠送课时');
			$this->_addCourse();
		}
		$this->meta_title = '报课';
		$this->assign('active_menu','addcourse/add');
		$this->display();
	}
	public function reject( ){
		$orderid = I('order_id');
		empty($orderid)  &&  $this->error('参数错误');
		if(IS_POST){

            $data['school_name'] = I('post.school_name');
            empty($data['school_name']) && $this->error('请输入学校名称');
            $data['course_name'] = I('post.course_name');
            empty($data['baby_birthday']) && $this->error('请输入课程名称');

            $data['course_count'] = I('post.course_count');
            empty($data['course_count']) && $this->error('请输入退课课时');

            $data['course_amount'] = I('post.course_amount');
            empty($data['course_amount']) && $this->error('请输入退课费用');

			$this->rejectSave();
		}
		$order = M('kcgl_add_course_order')->where("order_id='$orderid'")->find();
		$baby = M('yhgl_child')->where("id='{$order['child_id']}'")->find();
		$user = M('user')->where("id='{$baby['user_id']}'")->find();
		$course= M('kcgl_user_courses')->field('course_left')->where("user_id='{$baby['user_id']}'")->find();
		$this->meta_title = '退课';
		$this->assign('user',$user);
		$this->assign('course_left',$course['course_left']);
		$this->assign('baby',$baby);
		$this->assign('order',$order);
		$this->display();
	}
	public function rejectSave()
	{
		M()->startTrans();
		$order =M("kcgl_add_course_order")->where("order_id='".I('order_id')."'")->find();
		if(empty($order))
		{
			M()->rollback();
			$this->error('订单信息不存在！');
		}
		$child =M('yhgl_child')->where(['id'=>$order['child_id']])->find();
		$user =M('user')->where(['id'=>$child['user_id']])->find();
		$userCourseleft = $this->saveUserCourses($user['id'] ,$order);
		if($userCourseleft===false)
		{
			M()->rollback();
			$this->error('用户课程信息保存失败！');
		}
		$usercourse = M("kcgl_user_courses")->where(['order_id'=>$order['order_id']])->find();
		$memberid = $this->getMemberId($order['order_id']);
		$histroy = ['member_id'=>$memberid,'member_course_count'=>$userCourseleft,'type'=>'REJ','parent_name'=>$user['user_name']];
		$histroy = $user+$child+$usercourse+$order +$histroy;
		$rejorder = $this->saveROrder($histroy);
		if($rejorder ===false)
		{
			M()->rollback();
			$this->error('退订信息保存失败！');
		}
		$histroy['order_id'] = $rejorder;
		$histroy['add_order_id'] = $order['order_id'];
		$courseid = $this->saveHistroy($histroy);
		if($courseid===false)
		{
			M()->rollback();
			$this->error('历史信息保存失败！');
		}
		M()->commit();
		$this->success('退课成功！',U('addcourse/addcourselist'));
	}
	public function delete()
	{
		M()->startTrans();
		$order =M("kcgl_add_course_order")->where("order_id='".I('order_id')."'")->find();
		if(empty($order))
		{
			M()->rollback();
			$this->error('订单信息不存在！');
		}
		$child =M('yhgl_child')->where(['id'=>$order['child_id']])->find();
		$user =M('user')->where(['id'=>$child['user_id']])->find();
		$userCourseleft = $this->saveUserCourses($user['id'] ,$order);
		if($userCourseleft===false)
		{
			M()->rollback();
			$this->error('用户课程信息保存失败！');
		}
		M("kcgl_add_course_order")->where(['order_id'=>$order['order_id']])->save(['status'=>'FLS']);
		$usercourse = M("kcgl_user_courses")->where(['order_id'=>$order['order_id']])->find();
		$memberid = $this->getMemberId($order['order_id']);
		$histroy = ['member_id'=>$memberid,'member_course_count'=>$userCourseleft,'type'=>'DEL','parent_name'=>$user['user_name']];
		$histroy = $user+$child+$usercourse+$order +$histroy;
		$courseid = $this->saveHistroy($histroy);
		if($courseid===false)
		{
			M()->rollback();
			$this->error('历史信息保存失败！');
		}
		M()->commit();
		$this->success('删除成功！',U('addcourse/addcourselist'));
	}
	public function edit($id = 0){
		$orderid = I('order_id');
		empty($orderid)  &&  $this->error('参数错误');
		if(IS_POST){

            $data['mobile_num'] = I('post.mobile_num');
            empty($data['mobile_num']) && $this->error('请输入手机号码');
            if(!is_numeric($data['mobile_num'])){
                $this->error('请输入正确的手机号码');
            }
            $data['baby_name'] = I('post.baby_name');
            empty($data['baby_name']) && $this->error('请输入宝宝姓名');
            $data['baby_birthday'] = I('post.baby_birthday');
            empty($data['baby_birthday']) && $this->error('请输入宝宝生日');

            $data['school_name'] = I('post.school_name');
            empty($data['school_name']) && $this->error('请输入学校名称');
            $data['course_name'] = I('post.course_name');
            empty($data['baby_birthday']) && $this->error('请输入课程名称');

            $data['course_total'] = I('post.course_total');
            empty($data['course_total']) && $this->error('请输入课程课时');
            $data['course_amount'] = I('post.course_amount');
            empty($data['course_amount']) && $this->error('请输入买课费用');

            $data['course_price'] = I('post.course_price');
            empty($data['course_price']) && $this->error('请输入课程单价');
            $data['course_count'] = I('post.course_count');
            empty($data['course_count']) && $this->error('请输入购买课时');
            $data['given_count'] = I('post.given_count');
            empty($data['given_count']) && $this->error('请输入赠送课时');
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
		$histroy = ['child_id'=>$babyid,'order_id'=>$courseid,'member_id'=>$memberid,'member_course_count'=>$userCourseleft,'type'=>'UPT'];
		$histroy = $histroy +I('post.');
		$histroy['course_amount']=$histroy['course_amount']*100;
		$histroy['course_price']=$histroy['course_price']*100;
		$courseid = $this->saveHistroy($histroy);
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
			return $addCourse['order_id'];
		}
		return false;
	}
	private function saveUserCourses($userId,$order = array())
	{
		$kcglUserCourses=M("kcgl_user_courses");
		$addCourse=[];
		$userCoursesData =$kcglUserCourses->where(['user_id'=>$userId])->find();
		$course_count = intval(I('post.course_count'));
		$given_count = intval(I('post.given_count'));
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
	private function saveHistroy($data)
	{
		$addCourseHistory=[];
		$addCourseHistory['order_id'] = $data['order_id'];
		$addCourseHistory['member_id'] = $data['member_id'];
		$addCourseHistory['child_id'] = $data['child_id'];
		$addCourseHistory['school_name'] = $data['school_name'];
		$addCourseHistory['course_name'] = $data['course_name'];
		$addCourseHistory['course_total'] = $data['course_total'];
		$addCourseHistory['course_amount'] = $data['course_amount'];
		$addCourseHistory['course_price'] = $data['course_price'];
		$addCourseHistory['course_count'] = $data['course_count'];
		$addCourseHistory['given_course_count'] = $data['given_count'];
		$addCourseHistory['insert_time'] = time_format();
		$addCourseHistory['parent_name'] = $data['user_name'];
		$addCourseHistory['mobile_num'] = $data['mobile_num'];
		$addCourseHistory['baby_name'] = $data['baby_name'];
		$addCourseHistory['baby_sex'] = $data['baby_sex'];
		$addCourseHistory['baby_birthday'] = $data['baby_birthday'];
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
		if($memberid===false)
		{
			M()->rollback();
			$this->error('会员信息保存失败！');
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
		$histroy = ['child_id'=>$babyid,'order_id'=>$courseid,'member_id'=>$memberid,'member_course_count'=>$userCourseleft,'type'=>'ADD'];
		$histroy = $histroy +I('post.');

		$histroy['course_amount']=$histroy['course_amount']*100;
		$histroy['course_price']=$histroy['course_price']*100;
		$courseid = $this->saveHistroy(['child_id'=>$babyid,'order_id'=>$courseid,'member_id'=>$memberid,'member_course_count'=>$userCourseleft]);
		if($courseid===false)
		{
			M()->rollback();
			$this->error('历史信息保存失败！');
		}
		M()->commit();
		$this->success('报课成功！',U('addcourse/addcourselist'));
	}
	private function gen_order_no($type='AC00')
	{
		$orderid = $type.date('YmdHis').rand(1000,9999);
		return $orderid;
	}
	private function getMemberId($userid)
	{
		$order =M("hygl_member")->where("user_id='$userid'")->find();

		return isset($order['id'])?$order['id']:0;
	}
	private function saveROrder($data)
	{
		$addCourse=[];
		$addCourse['school_name'] = $data['school_name'];
		$addCourse['course_name'] = $data['course_name'];
		$addCourse['course_amount'] = $data['post.course_amount'];
		$addCourse['course_count'] = $data['post.course_count'];
		$addCourse['add_order_id'] = $data['post.order_id'];
		$addCourse['update_time'] = time_format();
		$addCourse['operator'] = is_login();
		$addCourse['insert_time'] = time_format();
		$addCourse['child_id']=$data['child_id'];
		$addCourse['add_order_id']=$data['order_id'];
		$addCourse['status']='OK#';
		$addCourse['order_id'] = $this->gen_order_no('RC00');
		$kcglAddCourseOrder=M("kcgl_reject_course_order");
		$addcourseId=$kcglAddCourseOrder->add($addCourse);
		if($addcourseId){
			return $addCourse['order_id'];
		}
		return false;
	}
}
