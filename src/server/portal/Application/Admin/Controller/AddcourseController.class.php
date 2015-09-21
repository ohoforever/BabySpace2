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
class AddcourseController extends ThinkController {



    public function addcourselist($p=0){

        $where = [];
        $baby_name = I('baby_name');
        if(!empty($baby_name)){
            $where['c.baby_name'] = ['like', '%'.(string)$baby_name.'%'];
        }
        $classname = I('classname');
        if(!empty($classname)){
            $where['a.classname'] = ['like', '%'.(string)$classname.'%'];
        }

        $school_name = I('school_name');
        if(!empty($school_name)){
            $where['b.school_name'] = ['like', '%'.(string)$school_name.'%'];
        }

        $where_string = [];
        $baby_age = I('baby_age');
        if(!empty($baby_age)){
            $where_string[] = "DATE_FORMAT(baby_birthday,'%Y-%m') = '".date('Y-m',strtotime("-$baby_age month"))."'";
        }

        $month = I('month');
        if(!empty($month)){
            $where_string[] = "DATE_FORMAT(act_time,'%Y-%m') = '".date('Y-')."$month'";
        }

        if(!empty($where_string)){
            $where['_string'] = implode(' AND ',$where_string);
        }

        if(!empty($order_id)){
            $where['a.order_id'] = $order_id;
        }

        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'bbkj_baby_attend_class a')
            ->join($prefix.'kcgl_add_course_order b on a.order_id = b.order_id')
            ->join($prefix.'yhgl_child c on a.child_id = c.id');


        $this->assign('_list', $this->lists($model,$where,'a.id desc','a.*,b.school_name,c.baby_name,c.baby_birthday'));

        $this->meta_title = '耗课列表查询';
        $this->display();

    }

    public function add(){
        $_POST['insert_time'] = time_format();
        $_POST['update_time'] = time_format();
        $_POST['reply_operator'] = is_login();
        $this->assign('active_menu','addcourse/addcourselist');
        parent::add(25,'addcourse/addcourselist');
    }

    public function edit($id = 0){
        $_POST['update_time'] = time_format();
        $_POST['reply_operator'] = is_login();
        $this->assign('active_menu','addcourse/addcourselist');
        parent::edit(25,$id,'addcourse/addcourselist');
    }

    public function online($id = 0){
        $status = I('status');
        if($status=='创建'||$status=='下线'){
            $value = 'OK#';
        }else{
            $value = 'FLS';
        }

        if(M('yxtg_advertisement')->where(['id'=>$id])->save(['status'=>$value,'update_time'=>time_format(),'reply_operator'=>is_login()])){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }

        $this->assign('active_menu','addcourse/addcourselist');

    }


}