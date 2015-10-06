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
class AdvertisementController extends ThinkController {



    public function advertisementlist($p=0){



        $this->assign('active_menu','advertisement/advertisementlist');

        $this->lists('yxtg_advertisement',$p,$map);
    }

    public function add(){
        $_POST['insert_time'] = time_format();
        $_POST['update_time'] = time_format();
        $_POST['operator'] = is_login();
        $this->assign('active_menu','advertisement/advertisementlist');
        parent::add(25,'advertisement/advertisementlist');
    }

    public function edit($id = 0){
        $_POST['update_time'] = time_format();
        $_POST['operator'] = is_login();
        $this->assign('active_menu','advertisement/advertisementlist');
        parent::edit(25,$id,'advertisement/advertisementlist');
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

        $this->assign('active_menu','advertisement/advertisementlist');

    }
}