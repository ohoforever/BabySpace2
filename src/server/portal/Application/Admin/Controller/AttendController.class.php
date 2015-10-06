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

    public function createqrcode(){

        $course_count = I('get.course_count');
        $class_name = I('get.class_name');
        if(!empty($course_count)){
            Vendor('phpqrcode');
//            $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxb88f2adbf549aa75&redirect_uri=%s&response_type=code&scope=snsapi_userinfo&state=index#wechat_redirect';
            $api = new ApiService();
            $redirect_url = "course_count=".$course_count.'&class_name='.$class_name;
            $resp = $api->setApiUrl(C('APIURI.wechat'))
                        ->setData(['params'=>$redirect_url])
                        ->send('wechat/url/attend');

            if(empty($resp) || $resp['errcode'] != '0'){
                $this->error('哎呀，出错了，请重新再试或联系管理员！');
            }

            header('Content-type: application/png');
            header('Content-Disposition: attachment; filename="'.urlencode('耗课'.$course_count.'节.png').'"');
            echo \QRcode::png($resp['url'],false,QR_ECLEVEL_L,15,2);
            die;
        }
        $this->meta_title = '耗课二维码生成';
        $this->display();
    }

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

        $sdate = I('sdate');
        if(!empty($sdate)){
            $where_string[] = "act_time >= '$sdate'";
        }
        $edate = I('edate');
        if(!empty($edate)){
            $where_string[] = "act_time <= '$edate'";
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
    public function historylist($order_id = ''){
        $prefix = C('DB_PREFIX');
        if(empty($order_id)){
            $this->error('参数错误');
        }
	$where['a.order_id'] = $order_id;
        $model = M()->table($prefix.'bbkj_baby_attend_class a')
                    ->join($prefix.'kcgl_add_course_order b on a.order_id = b.order_id')
                    ->join($prefix.'yhgl_child c on a.child_id = c.id');


        $this->assign('_list', $this->lists($model,$where,'a.id desc','a.*,b.school_name,c.baby_name,c.baby_birthday'));

        $this->meta_title = '耗课列表查询';
        $this->display();

    }

    function drop($id=0){

        if(empty($id)){
            $this->error('ID不能为空！');
        }

        $prefix = C('DB_PREFIX');
        $item = M()
                ->table($prefix.'bbkj_baby_attend_class a')
                ->join($prefix.'yhgl_child c on a.child_id = c.id')
                ->where(['a.id'=>$id])->field('a.*,c.user_id')
                ->find();
        if(empty($item)){
            $this->error('删除失败，数据不存在！');
        }

        //开启事务更新多个表
        M()->startTrans();

        $f1 = M('bbkj_baby_attend_class')->where(['id'=>$id])->delete();

        if($f1 && $this->_ott($item['course_count'],$item+['type'=>'DEL'])){
            M()->commit();
            $this->success('删除成功！',U('attend/index'));
        }else{
            M()->rollback();
            $this->error('删除失败，请重新再试！');
        }
    }

    private function _ott($step,$item){

        $f2 = M('kcgl_user_courses')
            ->where(['user_id'=>$item['user_id']])
            ->save(['course_left'=>['exp','course_left'.'+'.$step],'update_time'=>time_format()]);

        $bak = [
            'child_id'=>$item['child_id'],
            'classname'=>$item['classname'],
            'course_count'=>$item['course_count'],
            'act_time'=>$item['act_time'],
            'status'=>$item['status'],
            'operator'=>$item['operator'],
            'order_id'=>$item['order_id'],
            'type'=>$item['type'],
            'attend_id'=>$item['id'],
            'insert_time'=>$item['insert_time'],
            'update_time'=>$item['update_time'],
        ];
        $f3 = M('bbkj_baby_attend_class_history')->add($bak);

        return $f2 && $f3;
    }

    function edit($id=0){
        if(empty($id)){
            $this->error('ID不能为空！');
        }
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'bbkj_baby_attend_class a')
            ->join($prefix.'kcgl_add_course_order b on a.order_id = b.order_id')
            ->join($prefix.'yhgl_child c on a.child_id = c.id');

        $item = $model->where(['a.id'=>$id])
                    ->field('a.*,b.school_name,c.baby_name,c.baby_birthday,c.user_id')
                    ->find();

        if(IS_POST){
            $data = [];
            $data['course_count'] = I('post.course_count');
            $act_data = I('post.act_date');
            $time = I('post.act_time');

            $data['act_time'] = ($act_data.' '.$time);
            $data['update_time'] = time_format();
            //如果课数没有变的话，只更新一个表
            if($data['course_count']== $item['course_count']){
                if(M('bbkj_baby_attend_class')->where(['id'=>$id])->save($data)){
                    $this->success('修改成功！');
                }else{
                    $this->error('修改失败，请重新再试！');
                }
            }

            //否则要开启事务更新多个表
            M()->startTrans();

            $f1 = M('bbkj_baby_attend_class')->where(['id'=>$id])->save($data);
            $step =  $item['course_count'] - $data['course_count'];

            if($f1 && $this->_ott($step,$item+['type'=>'UPT'])){
                M()->commit();
                $this->success('修改成功！',U('attend/index'));
            }else{
                M()->rollback();
                $this->error('修改失败，请重新再试！');
            }
        }

        $this->assign('item',$item);
        $this->meta_title = '耗课修改';

        $this->display();
    }

    function add(){
        if(IS_POST){

            $data = [];
            $data['childId']    = I('post.childId');
            $data['courseName'] = I('post.courseName');
            $data['courseNum']  = I('post.courseNum');
	    (!is_numeric( $data['courseNum']) || $data['courseNum'] <=0)&& $this->error('耗课节数应该大于零！');
            $data['orderId']    = I('post.orderId');
            $data['operator']   = is_login();

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
	    $api = new ApiService();
	    $resp = $api->setApiUrl(C('APIURI.baby'))
		    ->setData(['unionId'=>$union_id,'courseNum'=>0,'courseName'=>'','mobileNum'=>$mobile])
		    ->send('courseManager/course/query');
	    if(!empty($resp) && $resp['errcode'] == '0'){
		    $list = $resp['list'];
	    }
	}

	$this->meta_title = '新增耗课';
	$this->assign('mobile',$mobile);
	$this->assign('list',$list);
	$this->display();
    }
}
