<?php
/**
 * @name IndexController
 * @author xuebingwang
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class WonderfullController extends MallController {

    /**
     * 宝贝精彩详情
     * @param int $id
     */
    public function detailAction($id=0){

        $this->layout->meta_title = '宝贝精彩';
        $this->layout->title = '宝贝精彩';
        if(isset($_SERVER['HTTP_REFERER'])){
            $this->layout->back_url = $_SERVER['HTTP_REFERER'];
        }else{
            $this->layout->back_url = '/';
        }

        if(empty($id)){
            $this->error("ID不能为空");
        }

        $curl = new Curl();
        $resp = $curl->setData(['unionId'=>$this->user['unionId'],'recordId'=>$id])
                    ->send('babyWonderful/queryBabyWonderfulDetail');
        if(empty($resp) || $resp['errcode'] != '0'){
            $this->error('哎呀,出错了,数据没找到！');
        }else{

            $this->getView()->assign('item',$resp['wonderfulDetail']);
        }

    }

    /**
     * 点赞动作
     */
    public function praiseAction(){
        $item_id = intval($this->getRequest()->getPost('item_id'));
        if(empty($item_id)){
            $this->error('点赞失败，ID不能为空！');
        }

        $curl = new Curl();
        $resp = $curl->setData(['unionId'=>$this->user['unionId'],'recordId'=>$item_id])
                    ->send('babyWonderful/praise');

        if(!empty($resp) && $resp['errcode'] == '0'){
            $this->success('点赞成功！');
        }else{
            $this->error('点赞失败！');
        }
    }
}
