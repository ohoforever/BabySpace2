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
class WonderfulController extends ThinkController {

    public function wonderfullist($p=0){



        $this->assign('active_menu','wonderful/wonderfullist');

        $this->lists('bbjc_baby_wonderful',$p,$map);
    }

    public function add(){
        if(IS_POST) {
            $data['title'] = I('post.title');
            empty($data['title']) && $this->error('请输入活动标题');
            $data['act_time'] = I('post.act_time');
            empty($data['act_time']) && $this->error('请输入活动时间');
        }
        $_POST['insert_time'] = time_format();
        $_POST['update_time'] = time_format();
        $_POST['operator'] = is_login();
        $this->assign('active_menu','wonderful/wonderfullist');
        parent::add(24,'wonderful/wonderfullist');
    }

    public function edit($id = 0){
        if(IS_POST) {
            $data['title'] = I('post.title');
            empty($data['title']) && $this->error('请输入活动标题');
            $data['act_time'] = I('post.act_time');
            empty($data['act_time']) && $this->error('请输入活动时间');
        }
        $_POST['update_time'] = time_format();
        $_POST['operator'] = is_login();
        $this->assign('active_menu','wonderful/wonderfullist');
        parent::edit(24,$id,'wonderful/wonderfullist');
    }
}