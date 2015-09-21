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
class EncyclopediaController extends ThinkController {

    public function encyclopedialist($p=0){



        $this->assign('active_menu','encyclopedia/encyclopedialist');

        $this->lists('zsgl_encyclopedia',$p,$map);
    }

    public function add(){
        $_POST['insert_time'] = time_format();
        $_POST['update_time'] = time_format();
        $_POST['reply_operator'] = is_login();
        $this->assign('active_menu','encyclopedia/encyclopedialist');
        parent::add(23,'encyclopedia/encyclopedialist');
    }

    public function edit($id = 0){
        $_POST['update_time'] = time_format();
        $_POST['reply_operator'] = is_login();
        $this->assign('active_menu','wonderful/wonderfullist');
        parent::edit(23,$id,'encyclopedia/encyclopedialist');
    }
}