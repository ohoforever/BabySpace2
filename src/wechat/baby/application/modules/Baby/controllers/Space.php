<?php
/**
 * @name IndexController
 * @author xuebingwang
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class SpaceController extends MemberController {

    /**
     *  宝宝空间
     */
    public function indexAction(){

        $this->layout->meta_title = '宝宝空间';
        $this->layout->title = '宝宝空间';
    }

    /**
     * 成长时光
     */
    public function growthTimeAction(){

        $this->layout->meta_title = '成长时光';
        $this->layout->title = '成长时光';

        $page = intval($this->getRequest()->getQuery('page'));
        $curl = new Curl();
        $resp = $curl->setData(['unionId'=>$this->user['unionId'],'pageIndex'=>$page,'pageSize'=>$this->config->application->pagenum])
            ->send('babyMature/queryBabyMatureList');

        $list = [];
        $total = 0;
        if(!empty($resp) && $resp['errcode'] == '0'){
            $list = $resp['list'];
            $total = $resp['total'];
        }

        $this->getView()->assign('list',$list);
        $this->getView()->assign('total',$total);
    }

    public function commentAction(){
        $data = ['unionId'=>$this->user['unionId']];
        $data['matureId'] = intval($this->getRequest()->getPost('item_id'));
        $data['comment'] = trim(htmlspecialchars($this->getRequest()->getPost('content')));
        $data['replyTo'] = $this->getRequest()->getPost('reply_to');
        if($data['comment'] == ''){
            $this->error('评论内容不能为空！');
        }

        $curl = new Curl();

        $resp = $curl->setData($data)
            ->send('babyMature/addComment');

        if(!empty($resp) && $resp['errcode'] == '0'){
            $this->success('评论成功！');
        }else{
            $this->error('矮油，不小心出错了<br>sorry...请重新再试！');
        }
    }

    /**
     * 课程
     */
    public function courseAction(){

        $this->layout->meta_title = '宝宝课程';
        $this->layout->title = '宝宝课程';

        $curl = new Curl();
        $resp = $curl->setData(['unionId'=>$this->user['unionId']])
            ->send('babyCourse/course/queryBabyCourseList');

        $list = [];
        $total = 0;
        if(!empty($resp) && $resp['errcode'] == '0'){
            $list = $resp['list'];
            $total = $resp['total'];
        }

        $this->getView()->assign('list',$list);
        $this->getView()->assign('total',$total);
    }

    /**
     * 课程详情
     * @param int $id
     */
    public function courseDetailAction($id=0){

        $this->layout->meta_title = '成长时光';
        $this->layout->title = '成长时光';

        if(empty($id)){
            $this->error("ID不能为空！");
        }
        $page = intval($this->getRequest()->getQuery('page'));

        $data = [];
        $data['schoolName'] = '全优加龙华校区';
        $data['babyName'] = '王子';
        $data['orderId'] = 'AC00201509241529098667';
        $data['pageIndex'] = $page;
        $data['pageSize'] = $this->config->application->pagenum;
        $curl = new Curl();
        $resp = $curl->setData($data)
            ->send('babyCourse/queryBabyCourseHistoryList');

        if(empty($resp) || $resp['errcode'] != '0'){
            $this->error('哎呀,出错了,数据没找到！');
        }else{
            $this->getView()->assign('item',$resp['result']);
        }
    }
}
