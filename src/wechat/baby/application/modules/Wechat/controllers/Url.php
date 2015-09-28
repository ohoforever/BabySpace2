<?php
use Yaf\Dispatcher;
/**
 * @name PublicController
 * @author xuebingwang
 * @desc Public控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class UrlController extends Yaf\Controller_Abstract  {

    protected $config;
    protected $wechat;
    protected $raw_data;
    
    public function init(){
//         Dispatcher::getInstance()->returnResponse(true);
        Dispatcher::getInstance()->disableView();
        
        $this->config = Yaf\Registry::get('config');
    
        $this->wechat = new Wechat($this->config->wechat->toArray());

        $this->raw_data = json_to_array($this->getRequest()->getParam('raw_data'));

        if(!isset($this->raw_data['body'])){
            throw new \Exception('{"errcode":10000,"errmsg":"body节点不能为空"}',10000);
        }
        $this->raw_data = $this->raw_data['body'];

    }

    public function attendAction(){

        $forward = urlencode(DOMAIN.'/scan/attend.html?'.$this->raw_data['params']);
        $url = DOMAIN.'/callback/spread.html?forward='.$forward;

        echo json_encode(['errcode'=>0,'errmsg'=>'成功！','url'=>$this->wechat->getShortUrl($this->wechat->getOauthRedirect($url,'','snsapi_base'))]);
    }

    public function bespeakAction(){

        $forward = urlencode(DOMAIN.'/scan/bespeak.html');
        $url = DOMAIN.'/callback/spread.html?forward='.$forward;

        echo json_encode(['errcode'=>0,'errmsg'=>'成功！','url'=>$this->wechat->getShortUrl($this->wechat->getOauthRedirect($url,'','snsapi_base'))]);
    }
}
