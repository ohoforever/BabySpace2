<?php
use Yaf\Dispatcher;
/**
 * @name PublicController
 * @author xuebingwang
 * @desc Public控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class AdminbackController extends Yaf\Controller_Abstract  {

    protected $config;
    protected $wechat;
    protected $raw_data;
    
    public function init(){
        $this->config =  new Yaf\Config\Ini(CONF_PATH.'assistant.ini');
        $this->wechat = new Wechat($this->config->wechat->toArray());
    }

    private function _getWxuserToken(){
        $code = $this->getRequest()->getQuery('code');
        if(empty($code)){
            $this->redirect('/?status=codenull');
            die;
        }

        $user_token = $this->wechat->getOauthAccessToken($code);
        //本地调试用
//        $user_token['openid'] = 'ozCgxuF_WRqY8RvETwnnc2y4Lf5g';
//        $user_token['unionid'] = 'olbkKt-8vkqpPod-N7i1SzSxddIo';
//        $user_token['scope'] = 'snsapi_base';

        if(empty($user_token) || !isset($user_token['openid'])){
            $this->redirect('/?status=get_user_token_faild');
            die;
        }

        return $user_token;
    }

    public function wxMenuAction(){

        $wx_user = $this->_wxAutoLogin();
        $this->getView()->assign('wx_user',$wx_user);

        $this->getView()->display('adminback/wxmenu.php');
        die;
    }

    /**
     * 微信自动登录
     * @return bool
     */
    private function _wxAutoLogin(){

        $user_token = $this->_getWxuserToken();

        $model = M('t_assistant_user');
        $user_info = $model->get('*',['unionid'=>$user_token['unionid']]);

        //如果用户不存在,并且应用授权作用域是snsapi_userinfo,则请求微信获取用户详情信息
        if(empty($user_info) && $user_token['scope'] == 'snsapi_userinfo'){

            //先通过openid直接获取用户信息
            $user_info = $this->wechat->getUserInfo($user_token['openid']);

            //如果从微信获取用户信息失败,或者用户未关注本公众号
            if(empty($user_info) || $user_info['subscribe'] != 1){
                //通过网页授权获取用户基本信息
                $user_info = $this->wechat->getOauthUserinfo($user_token['access_token'],$user_token['openid']);
                //再拿不到用户信息,则只能退出了
                if(empty($user_info)){
                    $this->redirect('/?status=userinfonull');
                    die;
                }
                //将用户特征信息转为json格式
                $user_info['privilege'] = json_encode($user_info['privilege'],JSON_UNESCAPED_UNICODE);
                $user_info['subscribe'] = -1;
            }

            //开始自动完成用户注册
            $user_info['userid'] = $model->insert($user_info);
            if($user_info['userid']){
                $this->redirect('/?status=userregfail');
                die;
            }
        }

        return $user_info;
    }

    /**
     * 微信接口Action
     * @return bool
     */
    public function wechatAction(){
        $this->raw_data = file_get_contents('php://input');
        SeasLog::debug("请求内容==>".$this->raw_data);

        $this->wechat->setPostXml($this->raw_data)->getRev();

        if(!$this->wechat->valid()){
	        die;
            //return false;
        }

        $type = $this->wechat->getRevType();
        switch($type) {
                case Wechat::MSGTYPE_EVENT:
                    $this->_do_event();
                    break;

                case Wechat::MSGTYPE_IMAGE:
                case Wechat::MSGTYPE_TEXT:
                case Wechat::MSGTYPE_VOICE:
                case Wechat::MSGTYPE_VIDEO:
                case Wechat::MSGTYPE_LINK:
                case Wechat::MSGTYPE_SHORTVIDEO:
                    $this->wechat->transfer_customer_service()->reply();
                break;

                default:
                    $this->wechat->text("help info")->reply();
        }
	    die;
    }

    /**
     * 事件方法
     */
    private function _do_event(){

        $event = $this->wechat->getRevEvent();
        switch($event['event']){
            case Wechat::EVENT_MENU_CLICK:
                if(method_exists($this,$event['key'])){
                    $this->$event['key']();
                }else{
                    $this->wechat->text('功能完善中，感谢您的关注！')->reply();
                }
                break;
            case Wechat::EVENT_LOCATION:
                //地理位置
                break;
            case Wechat::EVENT_SUBSCRIBE:
                //关注
                $openId = $this->wechat->getRevFrom();
                //首先获取微信用户的详细信息
                $userinfo = $this->wechat->getUserInfo($openId);

                $model = M('t_assistant_user');
                if(empty($userinfo)){
                    SeasLog::debug('靠,获取用户失败,此种情况应该不会出现,除非与微信通信失败了!');
                }else{
                    if($model->get('userid',['openid'=>$openId])){
                        $model->update(['subscribe'=>1,'update_time'=>time_format()]);
                    }elseif($model->insert($userinfo)){
                        Seaslog::error('出大事了，微信用户没有保存成功！');
                    }
                }
                
                $this->wechat->text('欢迎关注！')->reply();

                break;
            case Wechat::EVENT_UNSUBSCRIBE:
                //取消关注
                $openId = $this->wechat->getRevFrom();

                $model = new Model('t_assistant_user');
                if(!$model->update(['subscribe'=>0],['openid'=>$openId])){
                    SeasLog::error('取消关注的用户信息保存失败!');
                }
                break;
        }
    }
}
