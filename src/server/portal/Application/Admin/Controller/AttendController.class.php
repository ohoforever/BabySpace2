<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use Admin\Service\ApiService;
use User\Api\UserApi;
/**
 * 后台用户控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class AttendController extends AdminController {

    public function index($order_id = ''){

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

    function add(){
        if(IS_POST){

            $data = [];
            $data['childId'] = I('post.childId');
            $data['courseName'] = I('post.courseName');
            $data['courseNum'] = I('post.courseNum');
            $data['orderId'] = I('post.orderId');

            $api = new ApiService();
            $resp = $api->setApiUrl(C('APIURI.baby'))
                        ->setData($data)->send('courseManager/course/spend');
            if(!empty($resp) && $resp['errcode'] == '0'){
                $this->success($resp['errmsg']);
            }else{
                $this->error($resp['errmsg']);
            }
        }

        $mobile = I('get.mobile');
        $list = [];
        if(!empty($mobile)){
            $union_id = M('user')->where(['mobile_num'=>$mobile])->getField('union_id');
            if(!empty($union_id)){
                $api = new ApiService();
                $resp = $api->setApiUrl(C('APIURI.baby'))
                    ->setData(['unionId'=>$union_id,'courseNum'=>0,'courseName'=>''])
                    ->send('courseManager/course/query');
                if(!empty($resp) && $resp['errcode'] == '0'){
                    $list = $resp['list'];
                }
            }
        }

        $this->meta_title = '新增耗课';
        $this->assign('mobile',$mobile);
        $this->assign('list',$list);
        $this->display();
    }
}