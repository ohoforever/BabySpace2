<?php
use Yaf\Dispatcher;
/**
 * @name PublicController
 * @author xuebingwang
 * @desc Public控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class MessageController extends Yaf\Controller_Abstract  {

    protected $config;
    protected $wechat;
    protected $raw_data;
    
    public function init(){
//         Dispatcher::getInstance()->returnResponse(true);
        Dispatcher::getInstance()->disableView();
        
        $this->config = Yaf\Registry::get('config');
    
        $this->wechat = new Wechat($this->config->wechat->toArray());

        $this->raw_data = json_to_array($this->getRequest()->getParam('raw_data'));

        if(!isset($this->raw_data['body']) || empty($this->raw_data['body'])){
            throw new \Exception('{"errcode":10000,"errmsg":"body节点不能为空"}',10000);
        }
    }

    public function templateAction(){

        $result = $this->wechat->sendTemplateMessage($this->raw_data['body']);
        if(empty($result)){

            echo json_encode(['errcode'=>$this->wechat->errCode,'errmsg'=>$this->wechat->errMsg]);
        }else{
            echo json_encode($result);
        }
    }

    public function customAction(){

        $result = $this->wechat->sendCustomMessage($this->raw_data['body']);
        if(empty($result)){

            echo json_encode(['errcode'=>$this->wechat->errCode,'errmsg'=>$this->wechat->errMsg]);
        }else{
            echo json_encode($result);
        }
    }
}
