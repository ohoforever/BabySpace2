<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Common\Service\OrdersService;

/**
 * 模型数据管理控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class StatisticsController extends AdminController {

    public function visit(){

        $this->meta_title = '访问量统计';
        $this->display();
    }
    public function orders(){

        $prefix = C('DB_PREFIX');

        if(IS_AJAX && I('type') == 'add'){
            $month = intval(I('month'));
            $time = $month ? strtotime('-'.$month.' month') : time();

            $yk_totals = M()
                ->table($prefix.'orders o')
                ->join($prefix.'order_product op on op.sn = o.sn')
                ->join($prefix.'product p on p.id = op.product_id')
                ->where(['DATE_FORMAT(o.create_time,"%Y-%m")'=>date('Y-m',$time),'p.category_id'=>['NEQ',30]])
                ->group('DATE_FORMAT(o.create_time, "%Y-%m-%d")')
                ->getField('DATE_FORMAT(o.create_time, "%m-%d") AS create_date,count(*) as count');

            $add_totals = ['status'=>1];
            $m = date('m',$time);

            $jm_totals = M()
                ->table($prefix.'orders o')
                ->join($prefix.'order_product op on op.sn = o.sn')
                ->join($prefix.'product p on p.id = op.product_id')
                ->where(['DATE_FORMAT(o.create_time,"%Y-%m")'=>date('Y-m',$time),'p.category_id'=>30])
                ->group('DATE_FORMAT(o.create_time, "%Y-%m-%d")')
                ->getField('DATE_FORMAT(o.create_time, "%m-%d") AS create_date,count(*) as count');

            for($i=1;$i<=date("t",$time);$i++){
                $day = $m.'-'.($i<10 ? '0'.$i : $i);
                $add_totals['date'][] = $day;
                $add_totals['ykcount'][] = (isset($yk_totals[$day]) ? intval($yk_totals[$day]['count']) : 0);
                $add_totals['jmcount'][] = (isset($jm_totals[$day]) ? intval($jm_totals[$day]['count']) : 0);
            }

            $this->ajaxReturn($add_totals);
        }

        $tmp_total = M()->table($prefix.'orders o')
            ->join($prefix.'order_product op on op.sn = o.sn')
            ->join($prefix.'product p on p.id = op.product_id')
            ->where(['p.category_id'=>['NEQ',30]])
            ->group('o.status')
            ->getField('o.status,count(*) as count');

        $this->assign('yk_total',array_sum($tmp_total));
        $status_total = [];
        foreach(OrdersService::$status_text as $k=>$name){
            if($k == OrdersService::STATUS_COMPLETED){
                $status_total[] = [
                    'name'=>$name,
                    'y'=>intval(isset($tmp_total[$k]) ? $tmp_total[$k] : 0),
                    'sliced'=>true,
                    'selected'=>true
                ];
                continue;
            }
            $status_total[] = [$name,intval(isset($tmp_total[$k]) ? $tmp_total[$k] : 0)];
        }

        $this->assign('yk_total_json',json_encode($status_total,JSON_UNESCAPED_UNICODE));

        $tmp_total = M()->table($prefix.'orders o')
            ->join($prefix.'order_product op on op.sn = o.sn')
            ->join($prefix.'product p on p.id = op.product_id')
            ->where(['p.category_id'=>30])
            ->group('o.status')
            ->getField('o.status,count(*) as count');

        $this->assign('jm_total',array_sum($tmp_total));
        $status_total = [];
        foreach(OrdersService::$status_text as $k=>$name){
            if($k == OrdersService::STATUS_WATI_ACTIVE){
                continue;
            }
            if($k == OrdersService::STATUS_COMPLETED){
                $status_total[] = [
                                    'name'=>$name,
                                    'y'=>intval(isset($tmp_total[$k]) ? $tmp_total[$k] : 0),
                                    'sliced'=>true,
                                    'selected'=>true
                                  ];
                continue;
            }
            $status_total[] = [$name,intval(isset($tmp_total[$k]) ? $tmp_total[$k] : 0)];
        }

        $this->assign('jm_total_json',json_encode($status_total,JSON_UNESCAPED_UNICODE));

        $this->meta_title = '订单分析';
        $this->display();
    }

    public function users(){

        if(IS_AJAX && I('type') == 'add'){
            $month = intval(I('month'));
            $time = $month ? strtotime('-'.$month.' month') : time();

            $tmp_totals = M('wx_user')
                ->field('count(*) as count,DATE_FORMAT(add_time, "%m-%d") AS add_date')
                ->where(['DATE_FORMAT(add_time,"%Y-%m")'=>date('Y-m',$time),'subscribe'=>['GT',-1]])
                ->group('DATE_FORMAT(add_time, "%Y-%m-%d")')
                ->select();

            $add_totals = ['status'=>1];
            if(empty($tmp_totals)){
                $add_totals['status'] = 0;
                $add_totals['msg'] = '当前选择没有数据!';
            }

            foreach($tmp_totals as $tmp){
                $add_totals['date'][] = $tmp['add_date'];
                $add_totals['count'][] = intval($tmp['count']);
            }

            $this->ajaxReturn($add_totals);
        }

        $user_total = M('wx_user')
                    ->group('subscribe')
                    ->getField('subscribe,count(*) as count');

        $prefix = C('DB_PREFIX');
        $shop_total = M()->table($prefix.'wsyq_user_shopkeeper s')
                        ->join($prefix.'wx_user w on w.userid = s.user_id')
                        ->group('w.subscribe')
                        ->getField('w.subscribe,count(*) as count');

        foreach($user_total as $k=>&$total){
            $total = $total - $shop_total[$k];
        }

        $user_total['shop'] = array_sum($shop_total);
        $this->assign('user_total',$user_total);

        $hot_total = M()->table($prefix.'wsyq_distribution_user_relation r')
            ->join($prefix.'wx_user w on w.unionid = r.parentUserId')
            ->group('r.parentUserId')
            ->order('count desc')
            ->limit(10)
            ->getField('w.nickname, count(*) as count');
        $this->assign('hot_total',$hot_total);

        $this->meta_title = '微信用户分析';
        $this->display();
    }
}