<?php
/**
 * @name IndexController
 * @author xuebingwang
 * @desc 宝宝问答控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class FaqController extends MallController {

    /**
    * 默认动作，首页
    * Yaf支持直接把Yaf\Request_Abstract::getParam()得到的同名参数作为Action的形参
    * 对于如下的例子, 当访问http://yourhost/y/index/index/index/name/yantze 的时候, 你就会发现不同
    */
    public function indexAction(){

        $this->layout->meta_title = '宝宝问答';
        $this->layout->title = '宝宝问答';
        $this->layout->back_url = '/';
    }

    /**
     * 在线问答列表
     */
    public function listAction(){

        $this->layout->meta_title = '在线问答';
        $this->layout->title = '在线问答';
        $this->layout->back_url = '/faq/index.html';

        $page = intval($this->getRequest()->getPost('page',0))+1;

        $curl = new Curl();
        $resp = $curl->setData(['unionId'=>$this->user['unionId'],'pageIndex'=>$page,'pageSize'=>$this->config->application->pagenum])
                    ->send('knowledgeManager/babyInterlocution/questionList');

        if(IS_AJAX){
            if(empty($resp) || $resp['errcode'] != 0){
                $this->error('数据列表为空!');
            }
            $html = $this->render('ajaxFaq',['list'=>$resp['list']]);

            $this->ajaxReturn(['status'=>0,'html'=>$html,'list_total'=>count($resp['list']),'page'=>$page]);
        }

        $list = [];
        if(!empty($resp) && $resp['errcode'] == '0'){
            $list = $resp['list'];
        }

        $this->getView()->assign('list',$list);
        $this->getView()->assign('total',intval($resp['total']));
        $this->getView()->assign('pageIndex',$page);
    }

    /**
     * 我要问
     */
    public function askAction(){

        if(IS_POST){
            $data = ['unionId'=>$this->user['unionId']];
            $data['title'] = htmlspecialchars($this->getRequest()->getPost('title'),ENT_QUOTES);
            if(empty($data['title'])){
                $this->error('问题标题不能为空！');
            }
            $data['desc'] = htmlspecialchars($this->getRequest()->getPost('desc'),ENT_QUOTES);
            if(empty($data['desc'])){
                $this->error('问题描述不能为空！');
            }
            $curl = new Curl();

            $resp = $curl->setData($data)
                ->send('knowledgeManager/babyInterlocution/submitQuestion');

            if(!empty($resp) && $resp['errcode'] == '0'){
                $this->success('提交成功！','/faq/askSuccess.html');
            }else{
                $this->error('矮油，不小心出错了<br>sorry...请重新再试！');
            }

        }

        $this->layout->meta_title = '在线问答';
        $this->layout->title = '在线问答';
    }

    public function askSuccessAction(){
        $this->layout->meta_title = '在线问答';
        $this->layout->title = '提问成功';
        $this->layout->back_url = '/faq/list.html';

        $this->getView()->assign('message','提问成功，我们会尽快答复您，感谢您的参与！');

        $this->getView()->display(APP_PATH.'views/success.php');
        return false;
    }
    /**
     * 知识宝库
     */
    public function wikiAction(){

        $keyword = htmlspecialchars(trim($this->getRequest()->getQuery('keyword')));

        $page = intval($this->getRequest()->getPost('page',0))+1;

        $curl = new Curl();
        $resp = $curl->setData(['pageIndex'=>$page,'pageSize'=>8,'searchKeyword'=>$keyword])
            ->send('knowledgeManager/encyclopedia/queryEncyclopediaList');

        if(IS_AJAX){
            if(empty($resp) || $resp['errcode'] != 0){
                $this->error('数据列表为空!');
            }
            $html = $this->render('ajaxWiki',['list'=>$resp['list']]);

            $this->ajaxReturn(['status'=>0,'html'=>$html,'list_total'=>count($resp['list']),'page'=>$page]);
        }

        $list = [];
        if(!empty($resp) && $resp['errcode'] == '0'){
            $list = $resp['list'];
        }

        $this->layout->meta_title = '知识宝库';
        $this->layout->title = '知识宝库';
        if(!empty($keyword)){
            $this->layout->meta_title = '搜索结果';
            $this->layout->title = '搜索结果';
        }

        $this->getView()->assign('keyword',$keyword);
        $this->getView()->assign('list',$list);
        $this->getView()->assign('total',intval($resp['total']));
        $this->getView()->assign('pageIndex',$page);
    }

    /**
     * 知识宝库详情
     * @param int $id
     */
    public function wikiDetailAction($id=0){

        $this->layout->meta_title = '知识宝库';
        $this->layout->title = '知识宝库';

        if(empty($id)){
            $this->error("ID不能为空！");
        }

        $curl = new Curl();
        $resp = $curl->setData(['recordId'=>intval($id)])
            ->send('knowledgeManager/encyclopedia/queryEncyclopediaDetail');

        if(empty($resp) || $resp['errcode'] != '0'){
            $this->error('哎呀,出错了,数据没找到！');
        }else{
            $this->getView()->assign('item',$resp['result']);
        }
    }
}
