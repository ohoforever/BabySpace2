<?php
/**
 * @name IndexController
 * @author xuebingwang
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class IndexController extends MallController {

    public function bannerAction($id=0){

        $this->layout->meta_title = '广告';
        $this->layout->title = '广告';

        if(empty($id)){
            $this->error("ID不能为空！");
        }

        $curl = new Curl();
        $resp = $curl->setData(['advertisementId'=>intval($id)])
            ->send('advertisement/getAdvertisementDetail');

        if(empty($resp) || $resp['errcode'] != '0'){
            $this->error('哎呀,出错了,数据没找到！');
        }else{
            $this->getView()->assign('item',$resp['result']);
        }

    }
    /**
    * 默认动作，首页
    * Yaf支持直接把Yaf\Request_Abstract::getParam()得到的同名参数作为Action的形参
    * 对于如下的例子, 当访问http://yourhost/y/index/index/index/name/yantze 的时候, 你就会发现不同
    */
    public function indexAction(){
        if(IS_AJAX){
            $this->_getWonderfulList();
        }

        //读取缓存
        $cache_name = ROOT_PATH.'/runtime/cache/'.md5($this->getMCA()).'.php';
        $this->layout->meta_title = '';

        if(!$this->config->application->debug && file_exists($cache_name)){
            $this->getResponse()->setBody(file_get_contents($cache_name));
            return false;
        }

        $curl = new Curl();
        $resp = $curl->setData(['unionId'=>$this->user['unionId'],'pageIndex'=>1,'pageSize'=>$this->config->application->pagenum])
                    ->send('advertisement/getAdvertisementList');
        
        $banners = [];
        if(!empty($resp) && $resp['errcode'] == 0){
            $banners = $resp['list'];
        }

        $this->_getWonderfulList();

        $this->getView()->assign('banners',$banners);

        //生成缓存文件
        file_put_contents($cache_name,$this->render($this->getAction()));
    }

    private function _getWonderfulList(){

        $page = intval($this->getRequest()->getPost('page',0))+1;
        $curl = new Curl();
        $resp = $curl->setData(['unionId'=>$this->user['unionId'],'pageIndex'=>$page,'pageSize'=>$this->config->application->pagenum])
                    ->send('babyWonderful/babyWonderfulList');

        $list = [];
        if(!empty($resp) && $resp['errcode'] == 0){
            $list = $resp['list'];
        }

        if(IS_AJAX){
            if(empty($list)){
                $this->error('数据列表为空!');
            }
            $html = $this->render('ajaxWonderfull',['wonderfulLs'=>$list]);
            $this->ajaxReturn(['status'=>0,'html'=>$html,'list_total'=>count($list),'page'=>$page]);
        }

        $this->getView()->assign('wonderfulLs',$list);
        $this->getView()->assign('total',intval($resp['total']));
        $this->getView()->assign('pageIndex',$page);
    }

    public function joinAction(){

        $this->layout->meta_title = '现场扫码';
        $this->layout->title = '现场扫码';

        $this->getView()->assign('btn_text','注册参加');
        $this->getResponse()->setBody($this->getView()->render('index/bespeak.php'));
        return false;
    }
    /**
     * 预约动作
     */
    public function bespeakAction(){

        if(IS_POST){

            //TODO 先验证手机验证码
            $data['mobileNum']  = trim($this->getRequest()->getPost('mobile'));

            $smsCode = trim($this->getRequest()->getPost('sms_code'));

            $msg = test_mobile_sms($data['mobileNum'],$smsCode);
            if(!empty($msg)){
                $this->error($msg);
            }

            $data['babyName']   = trim($this->getRequest()->getPost('baby_name'));
            $tmp                = explode(':',trim($this->getRequest()->getPost('city')));
            $data['city']       = $tmp[1];
            $data['district']   = trim($this->getRequest()->getPost('district'));

            $alert_title = [
                'mobileNum'=>'手机号码',
                'babyName'=>'宝宝姓名',
                'city'=>'所在城市',
                'district'=>'所在城市',
            ];
            foreach($data as $key=>$value){
                if(empty($value)){
                    $this->error($alert_title[$key].'不能为空！');
                }
            }

            $data['unionId'] = $this->user['unionId'];

            $year   = intval($this->getRequest()->getPost('year'));
            $month  = intval($this->getRequest()->getPost('month'));
            $month  = $month < 10 ? '0'.$month : $month;
            $day    = intval($this->getRequest()->getPost('day'));
            $day    = $day < 10 ? '0'.$day : $day;

            $data['babyBirthday'] = $year.'-'.$month.'-'.$day;
            $data['babySex'] = trim($this->getRequest()->getPost('baby_sex'));

            $data['userName'] = '';
            $curl = new Curl();
            $resp = $curl->setData($data)->send('customerDev/candidate/add');
            if(!empty($resp) && $resp['errcode'] == '0'){
                $this->success('预约成功！','/index/bespeakSuccess.html');
            }else{
                $this->error('矮油，不小心出错了<br>sorry...请重新再试！');
            }
        }

        $this->layout->meta_title = '在线预约';
        $this->layout->title = '我要预约';
    }

    public function bespeakSuccessAction(){
        $this->layout->meta_title = '在线预约';
        $this->layout->title = '我要预约';
    }

    /**
     * 成长时光详情
     * @param int $id
     */
    public function growthTimeAction($id=0){

        $this->layout->meta_title = '成长时光';
        $this->layout->title = '成长时光';
        if(isset($_SERVER['HTTP_REFERER'])){
            $this->layout->back_url = $_SERVER['HTTP_REFERER'];
        }else{
            $this->layout->back_url = '/';
            $this->getView()->assign('show_yuyue',true);
        }

        if(empty($id)){
            $this->error("ID不能为空！");
        }

        $curl = new Curl();
        $resp = $curl->setData(['matureId'=>intval($id)])
            ->send('babyMature/getBabyMature');

        if(empty($resp) || $resp['errcode'] != '0'){
            $this->error('哎呀,出错了,数据没找到！');
        }else{
            $this->getView()->assign('item',$resp['result']);
            $this->getView()->assign('user',$this->user);
        }
    }
}
