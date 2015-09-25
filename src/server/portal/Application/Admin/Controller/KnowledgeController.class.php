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
class KnowledgeController extends ThinkController {

    public function bbwdlist($p=0){

        $map = [];
        $status = I('status');

        if(!empty($status)){
            if($status == '1'){
                $map= 'answer is not null';
            }else{
                $map['answer'] = null;
            }
        }
        $model = M('zsgl_interlocution');

//        var_dump($map);die;
        $status_list = [
            '0'=>'-全部-',
            '1'=>'已回复',
            '2'=>'未回复'
        ];
        $this->assign('status_list',$status_list);

        $this->assign('active_menu','knowledge/bbwdlist');

        $this->lists('zsgl_interlocution',$p,$map);
    }
    public function answer($id = 0){
        $_POST['reply_time'] = time_format();
        $_POST['reply_operator'] = is_login();
        $this->assign('active_menu','knowledge/bbwdlist');

        parent::edit(22,$id,'knowledge/bbwdlist');
    }
}