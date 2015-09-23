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
        /*$this->meta_title = '报课';
        $this->assign('mobile',$mobile);
        $this->assign('list',$list);
        $this->display();
*/
        $this->assign('active_menu','addcourse/add');
        $this->display();
    }

    private function _addCourse(){
        //开启事务更新多个表
        M()->startTrans();
        $mobile_num= I('post.mobile_num');
        $user = M("user"); // 实例化User对象
        $condition['mobile_num'] = $mobile_num;
        $userData =$user->where($condition)->find();
        //用户表
        $admin = [];
        $admin['user_name'] = I('post.user_name');
        $admin['mobile_num'] = I('post.mobile_num');
        $admin['city'] = I('post.city');
        $admin['district'] = I('post.district');
        $admin['qq'] = I('post.qq');
        $admin['email'] = I('post.email');
        $admin['insert_time'] = time_format();
        $admin['update_time'] = time_format();
        $userId=0;

        //会员表
        $member = [];

        $member['update_time'] = time_format();
        $member['status'] = 'OK#';
        $hyglMember=M("hygl_member");
        if(!empty($userData)){
            //修改用户信息
            $user->where(['mobile_num'=>$mobile_num])->save($admin);
            $userId=$userData['id'];

            $memberData =$hyglMember->where(['user_id'=>$userData['id']])->find();

            if(!empty($memberData)){
                //修改会员信息
                $memberId=$hyglMember->where(['user_id'=>$userId])->save($member);
            }else{
                //新增会员
                $member['user_id'] = $userId;
                $member['insert_time'] = time_format();
                $memberId=$hyglMember->add($member);
            }
        }else{
            //添加用户
            $userResult=$user->add($admin);
            if($userResult){        // 如果主键是自动增长型 成功后返回值就是最新插入的值
                $userId = $userResult;
                $member['user_id'] = $userId;
                $member['insert_time'] = time_format();
                $memberId=$hyglMember->add($member);
            }else{
                $this->error('用户保存失败！');
            }
        }


        //宝宝表
        $child=[];
        $child['baby_name'] = I('post.baby_name');
        $child['baby_sex'] = I('post.baby_sex');
        $child['baby_birthday'] = I('post.baby_birthday');
        $childId = I('post.childId');
        $yhglChild=M("yhgl_child");
        $childData =$yhglChild->where(['id'=>$childId])->find();
        if(!empty($childData)){
            $yhglChild->where(['id'=>$childId])->save($child);
        }else{
            $childId=$yhglChild->add($child);
            if(!$childId){
                $this->error('宝宝信息保存失败！');
            }
        }

        //课程表
        $addCourse=[];
        $addCourse['school_name'] = I('post.school_name');
        $addCourse['course_name'] = I('post.course_name');
        $addCourse['course_total'] = I('post.course_total');
        $addCourse['course_amount'] = I('post.course_amount');
        $addCourse['course_count'] = I('post.course_count');
        $addCourse['given_count'] = I('post.given_count');
        $addCourse['child']=$childId;
        $addCourse['insert_time'] = time_format();
        $addCourse['update_time'] = time_format();
        $addCourse['operator'] = is_login();
        $addCourse['order_id'] = gen_order_no();

        $kcglAddCourseOrder=M("kcgl_add_course_order");

        $addcourseId=$kcglAddCourseOrder->add($addCourse);
        if(!$addcourseId){
            $this->error('课程信息保存失败！');
        }

        //会员课数表
        $kcglUserCourses=M("kcgl_user_courses");

        $userCoursesData =$kcglUserCourses->where(['user_id'=>$userId])->find();

        $addCourse=[];
        if(!empty($userCoursesData)){

            $userCourseNum=$userCoursesData['course_left'];
            $addCourse['course_count'] =$userCoursesData['course_count']+$addCourse['course_count']+$userCoursesData['given_count'];
            $addCourse['update_time'] = time_format();
            $kcglUserCourses->where(['user_id'=>$userId])->save($addCourse);

        }else{
            $addCourse['course_count'] =$userCoursesData['course_count']+$userCoursesData['given_count'];
            $addCourse['insert_time'] = time_format();
            $addCourse['update_time'] = time_format();
            $addCourse['course_left'] = $userCoursesData['course_count']+$userCoursesData['given_count'];
            $userCourseNum=$addCourse['course_left'];
            $kcglUserCourses->where(['user_id'=>$userId])->add($addCourse);

        }


        //课程表
        $addCourseHistory=[];
        $addCourseHistory['order_id'] = $addCourse['order_id'];
        $addCourseHistory['member_id'] = $memberId;
        $addCourseHistory['child_id'] = $addCourse['child_id'];
        $addCourseHistory['school_name'] =$addCourse['school_name'];
        $addCourseHistory['course_name'] =$addCourse['course_name'];
        $addCourseHistory['course_count'] = $addCourse['course_count'];
        $addCourseHistory['course_amount']=$addCourse['course_amount'];
        $addCourseHistory['insert_time'] = time_format();
        $addCourseHistory['mobile_num'] = $admin['mobile_num'];
        $addCourseHistory['parent_name'] = $admin['user_name'];
        $addCourseHistory['baby_name'] = $child['baby_name'];
        $addCourseHistory['baby_sex'] = $child['baby_sex'];
        $addCourseHistory['baby_birthday'] =  $child['baby_birthday'];
        $addCourseHistory['member_course_count'] =$userCourseNum;
        $addCourseHistory['given_count'] =$addCourse['given_count'];
        $addCourseHistory['type'] = 'ADD';
        $addCourseHistory['operator'] = is_login();
        $addCourseHistory['course_total'] = $addCourse['course_total'];
        $kcglOperCourseHistory=M("kcgl_oper_course_history");
        $addcourseHistoryId=$kcglOperCourseHistory->add($addCourseHistory);
        if(!$addcourseHistoryId){
            $this->error('课程信息历史保存失败！');
        }
        if($userId&&$memberId&&$child&&$addcourseId&&$addcourseHistoryId){
            M()->commit();
            $this->success('报课成功！',U('addcourse/addcourselist'));
        }

}

}