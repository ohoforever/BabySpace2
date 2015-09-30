<?php
/**
 * @name PublicController
 * @author xuebingwang
 * @desc Public控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class PublicController extends MallController {

    public function bindSuccessAction(){

        $this->layout->meta_title = '绑定账号';
        $this->layout->title = '绑定账号';
        $this->layout->back_url = '/';

        $this->success('<a href="/">绑定成功，点击这里返回首页</a>');
    }
    /**
     * 绑定家长账号
     */
    public function bindAction(){

        if(IS_POST){
            $data = [];
            $data['mobileNum'] = trim($this->getRequest()->getPost('mobile'));
            $smsCode = trim($this->getRequest()->getPost('sms_code'));

            $msg = test_mobile_sms($data['mobileNum'],$smsCode);
            if(!empty($msg)){
                $this->error($msg);
            }

            $data['unionId'] = $this->user['unionId'];

            $curl = new Curl();
            $resp = $curl->setData($data)->send('userCenter/user/bind');
            if(!empty($resp) && $resp['errcode'] == '0'){
                $this->user['isMember'] = true;
                //将新的用户信息放入会话中
                session('user_auth',$this->user);

                $this->success('绑定成功！','/public/bindSuccess.html');
            }else{
                $this->error($resp['errmsg']);
            }
        }
        $this->layout->meta_title = '绑定账号';
        $this->layout->title = '绑定账号';
    }

    public function sendBindSmsAction(){

        $mobileNum = trim($this->getRequest()->getPost('mobile',''));
        if(M('t_user')->get('mobile_num',['mobile_num'=>$mobileNum])){
            $this->sendSmsCodeAction();
        }else{
            $this->error('该手机号码还未购买过课程，不允许绑定！');
        }
    }

    public function sendSmsCodeAction(){

        $mobileNum = trim($this->getRequest()->getPost('mobile',''));
        if(empty($mobileNum)){
            $this->error('手机号码不能为空！');
        }

        $code = mt_rand(1000,9999);
        $data = $this->config->url->api->sms->toArray();
        $url    = array_shift($data);
        $data['mobileNum']  = $mobileNum;
        $data['content']    = sprintf($data['content'],$code);

        $curl = new Curl();
        $resp = $curl->setApiUrl($url)->setData2($data,false)->send('');

//        $resp = ['errcode'=>0];
        if($resp['errcode'] == 0){

            //将短信验证码、手机、创建时间保存至会话中
            session('MobileSmsCode',['code'=>$code,'time'=>time(),'mobile'=>$mobileNum]);
            SeasLog::debug('短信验证码:'.var_export($code,true));

            $this->success('验证码发送成功！');
        }else{
            $this->error('验证码发送失败，请重新再试！');
        }
    }

    public function createWxMenu2Action(){

        $this->config =  new Yaf\Config\Ini(CONF_PATH.'assistant.ini');
        $this->wechat = new Wechat($this->config->wechat->toArray());

        $base_url = 'http://mm.mi360.me/';
        $newmenu =  [
            "button"=>[
                [
                    'name'=>'访问后台',
                    'type'=>'view',
                    'url'=>$this->wechat->getOauthRedirect($base_url.'adminback/wxmenu','index'),
                ],
                [
                    'name'=>'绑定账号',
                    'type'=>'view',
                    'url'=>$this->wechat->getOauthRedirect($base_url.'adminback/wxmenu','bind'),
                ],
                [
                    'name'=>'我的',
                    'type'=>'view',
                    'url'=>$this->wechat->getOauthRedirect($base_url.'adminback/wxmenu','myinfo'),
                ]
            ]
        ];
        $result = $this->wechat->createMenu($newmenu);
        var_dump($result);die;
    }

    public function createWxMenuAction(){
        $base_url = 'http://mm.mi360.me/';
        $newmenu =  [
                        "button"=>[
                                        [
                                            'name'=>'首页',
                                            'type'=>'view',
                                            'url'=>$this->wechat->getOauthRedirect($base_url.'callback/wxmenu','index'),
                                        ],
                                        [
                                            'name'=>'宝宝空间',
                                            'type'=>'view',
                                            'url'=>$this->wechat->getOauthRedirect($base_url.'callback/wxmenu','space'),
                                        ],
                                        [
                                            'name'=>'宝宝问答',
                                            'type'=>'view',
                                            'url'=>$this->wechat->getOauthRedirect($base_url.'callback/wxmenu','faq'),
                                        ]
                                    ]
                    ];
        $result = $this->wechat->createMenu($newmenu);
        var_dump($result);die;
    }

    public function getcityAction(){

        $data = [];

        $sql = "select * from t_xbdistrict where `level` < 4 and (id like '2810%' or id like '2812%')";
        foreach (M()->query($sql)->fetchAll(PDO::FETCH_ASSOC) as $tmp){
            $data[$tmp['pid']][$tmp['id']] = array($tmp['id'],$tmp['name']);
        }

        $this->ajaxReturn($data,'json',JSON_UNESCAPED_UNICODE);

        echo '{"28":{"2810":["2810","广州市"],"2812":["2812","深圳市"]},"2810":{"281010":["281010","萝岗区"],"281011":["281011","南沙区"],"281012":["281012","从化市"],"281013":["281013","增城市"],"281014":["281014","天河区"],"281015":["281015","海珠区"],"281016":["281016","番禺区"],"281017":["281017","白云区"],"281018":["281018","花都区"],"281019":["281019","荔湾区"],"281020":["281020","越秀区"],"281021":["281021","黄埔区"]},"2812":{"281210":["281210","南山区"],"281211":["281211","宝安区"],"281212":["281212","盐田区"],"281213":["281213","福田区"],"281214":["281214","罗湖区"],"281215":["281215","龙岗区"]}}';
        die;
    }

    public function districtAction(){

        echo '{"28":{"2810":["2810","广州市"],"2812":["2812","深圳市"]},"2810":{"281010":["281010","萝岗区"],"281011":["281011","南沙区"],"281012":["281012","从化市"],"281013":["281013","增城市"],"281014":["281014","天河区"],"281015":["281015","海珠区"],"281016":["281016","番禺区"],"281017":["281017","白云区"],"281018":["281018","花都区"],"281019":["281019","荔湾区"],"281020":["281020","越秀区"],"281021":["281021","黄埔区"]},"2812":{"281210":["281210","南山区"],"281211":["281211","宝安区"],"281212":["281212","盐田区"],"281213":["281213","福田区"],"281214":["281214","罗湖区"],"281215":["281215","龙岗区"]}}';
        die;
    }
    
}
