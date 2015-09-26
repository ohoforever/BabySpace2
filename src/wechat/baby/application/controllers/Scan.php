<?php
/**
 * @name IndexController
 * @author xuebingwang
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class ScanController extends MallController {

    public function bespeakAction(){

        $this->layout->meta_title = '现场扫码';
        $this->layout->title = '现场扫码';

        $curl = new Curl();
        $resp = $curl->setData(['unionId'=>$this->user['unionId']])
            ->send('customerDev/judgeAppointment');

        if(!empty($resp) && $resp['errcode'] == '0'){
            if($resp['isAppointment']){
                $this->success('确认成功！');
            }

            $this->getView()->assign('btn_text','注册参加');
            $this->getResponse()->setBody($this->getView()->render('index/bespeak.php'));
            return false;
        }else{
            $this->error('矮油，不小心出错了<br>sorry...请重新再试！');
        }
    }

    /**
     * 扫码耗课
     */
    public function attendAction(){

        $this->layout->meta_title = '现场扫码';
        $this->layout->title = '现场扫码';

        //如果非会员
        if(!$this->user['isMember'] && $this->user['subscribe'] > -1){
            //如果既不是家长也没关注本公众号，则认为其是扫错了二维码
            $this->error('<a href="/public/bind.html">对不起，您还没有绑定家长手机号码，点击这里绑定！</a>');
            $this->redirect('/public/bind.html');
        }elseif($this->user['subscribe'] < 1){
            //如果既不是家长也没关注本公众号，则认为其是扫错了二维码
            $this->error('<a href="/index/join.html">对不起，您是不是扫错二维码了，点击这里填写资料后参加试听！</a>');
        }

        $course_count = $this->getRequest()->getQuery('course_count',1);
        $class_name = $this->getRequest()->getQuery('class_name');

        $curl = new Curl();
        $resp = $curl->setData(['unionId'=>$this->user['unionId'],'courseNum'=>$course_count,'courseName'=>$class_name])
            ->send('courseManager/course/query');

        $list = [];
        if(!empty($resp) && $resp['errcode'] == 0){
            $list = $resp['list'];
        }

        $this->getView()->assign('list',$list);
    }

    public function doAttendAction (){

        $data = [];

        $data['childId'] = $this->getRequest()->getPost('childId');
        $data['courseName'] = $this->getRequest()->getPost('courseName');
        $data['courseNum'] = $this->getRequest()->getPost('courseNum');
        $data['orderId'] = $this->getRequest()->getPost('orderId');

        $curl = new Curl();
        $resp = $curl->setData($data)
            ->send('courseManager/course/spend');

        if(!empty($resp) && $resp['errcode'] == '0'){
            $this->success('耗课成功！','/scan/attendSuccess.html');
        }else{
            $this->error('矮油，不小心出错了<br>sorry...请重新再试！');
        }
    }

    public function attendSuccessAction(){
        $this->layout->meta_title = '现场扫码';
        $this->layout->title = '耗课成功';

        $this->success('<a href="/">耗课成功，请点击返回！</a>');
    }
}
