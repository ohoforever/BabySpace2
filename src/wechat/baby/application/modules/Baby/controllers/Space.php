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
        $this->layout->back_url = '/';
    }

    /**
     * 成长时光
     */
    public function growthTimeAction(){

        $this->layout->meta_title = '成长时光';
        $this->layout->title = '成长时光';
        $this->layout->back_url = '/baby/space/index.html';

        $page = intval($this->getRequest()->getPost('page',0))+1;

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
        $data               = ['unionId'=>$this->user['unionId']];
        $data['matureId']   = intval($this->getRequest()->getPost('item_id'));
        $data['comment']    = trim(htmlspecialchars($this->getRequest()->getPost('content')));
        $data['replyTo']    = $this->getRequest()->getPost('reply_to');
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

        $this->layout->meta_title   = '宝宝课程';
        $this->layout->title        = '宝宝课程';

        $curl = new Curl();
        $resp = $curl->setData(['unionId'=>$this->user['unionId']])
            ->send('babyCourse/course/queryBabyCourseList');

        $list = [];
        if(!empty($resp) && $resp['errcode'] == '0'){
            $list = $resp['list'];
        }

        $this->getView()->assign('list',$list);
    }

    /**
     * 课程详情
     * @param int $order_id
     */
    public function courseDetailAction($order_id=0){

        $this->layout->meta_title   = '耗课历史';
        $this->layout->title        = '耗课历史';

        if(empty($order_id)){
            $this->error("订单ID不能为空！");
        }
        $page = intval($this->getRequest()->getPost('page',0))+1;

        $data = [];
        $data['schoolName'] = '';
        $data['babyName'] = '';
        $data['orderId'] = $order_id;
        $data['pageIndex'] = $page;
        $data['pageSize'] = 6;
        $curl = new Curl();
        $resp = $curl->setData($data)
            ->send('babyCourse/queryBabyCourseHistoryList');

        if(IS_AJAX){
            if(empty($resp) || $resp['errcode'] != 0){
                $this->error('数据列表为空!');
            }
            $html = $this->render('ajaxCourse',['list'=>$resp['list']]);

            $this->ajaxReturn(['status'=>0,'html'=>$html,'list_total'=>count($resp['list']),'page'=>$page]);
        }

        if(empty($resp) || $resp['errcode'] != '0'){
            $this->error('哎呀,出错了,数据没找到！');
        }

        $this->getView()->assign('list',$resp['list']);
        $this->getView()->assign('total',intval($resp['total']));
        $this->getView()->assign('pageIndex',$page);
    }

}
