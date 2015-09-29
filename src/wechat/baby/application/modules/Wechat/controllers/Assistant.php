<?php
use Yaf\Dispatcher;
/**
 * @name PublicController
 * @author xuebingwang
 * @desc Public控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class AssistantController extends MessageController  {

    protected $config;
    protected $wechat;
    protected $raw_data;
    
    public function init(){
        parent::init();
        $this->config =  new Yaf\Config\Ini(CONF_PATH.'assistant.ini');
        $this->wechat = new Wechat($this->config->wechat->toArray());
    }
}
