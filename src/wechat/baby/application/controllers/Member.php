<?php
/**
 * @name MallController
 * @author xuebingwang
 * @desc 商城基控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class MemberController extends MallController {

    public function init(){
        parent::init();

        if(!$this->user['isMember']){
            $this->redirect('/public/bind.html');
        }
    }
}
