<?php
/**
 * @name IndexController
 * @author xuebingwang
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class IndexController extends MallController {

    public function init(){
        parent::init();
    }

    /**
    * 默认动作，首页
    * Yaf支持直接把Yaf\Request_Abstract::getParam()得到的同名参数作为Action的形参
    * 对于如下的例子, 当访问http://yourhost/y/index/index/index/name/yantze 的时候, 你就会发现不同
    */
    public function indexAction(){
        //读取缓存
        $cache_name = ROOT_PATH.'/runtime/cache/'.md5($this->getMCA()).'.php';
        $this->layout->meta_title = '';

        if(!$this->config->application->debug && file_exists($cache_name)){
            $this->getResponse()->setBody(file_get_contents($cache_name));
            return false;
        }
        $curl = new Curl();
        $resp = $curl->setData(['unionId'=>$this->user['unionId'],'pageIndex'=>0,'pageSize'=>$this->config->application->pagenum])
                    ->send('advertisement/getAdvertisementList');
        
        $banners = [];
        if(!empty($resp) && $resp['errcode'] == 0){
            $banners = $resp['list'];
        }

        $resp = $curl->setData(['unionId'=>$this->user['unionId'],'pageIndex'=>0,'pageSize'=>$this->config->application->pagenum])
                    ->send('babyWonderful/babyWonderfulList');

        $wonderfulLs = [];
        if(!empty($resp) && $resp['errcode'] == 0){
            $wonderfulLs = $resp['list'];
        }

        $this->getView()->assign('banners',$banners);
        $this->getView()->assign('wonderfulLs',$wonderfulLs);

        //生成缓存文件
        file_put_contents($cache_name,$this->render($this->getAction()));
    }

    /**
     * 预约动作
     */
    public function bespeakAction(){

        if(IS_POST){

            //TODO 先验证手机验证码
            $data['mobileNum']  = trim($this->getRequest()->getPost('mobile'));

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
        }
    }
}
