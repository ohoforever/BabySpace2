<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Admin\Service\ApiService;

/**
 * 模型数据管理控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class ModulesController extends ThinkController {

	private $model_id = 17;

    /**
     * 显示指定模型列表数据
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     * @param int $p
     */
    public function lists($p = 0){
        $this->assign('active_menu','modules/lists');
        parent::lists('page_modules',$p,['status'=>['gt',-1]]);
    }

    public function edit($model = null, $id = 0){


        //获取模型信息
        $model = M('Model')->find($this->model_id);
        $model || $this->error('模型不存在！');

        if(IS_POST){
            $Model  =   D(parse_name(get_table_name($model['id']),1));
            // 获取模型的字段信息
            $Model  =   $this->checkAttr($Model,$model['id']);
            $_POST['update_time'] = time_format(null,'Y-m-d H:i:s');

            if($Model->create() && $Model->save()){
                $method = I('post.name');
                if(!empty($method) && method_exists($this,$method)){
                    $this->$method();
                }
                $this->success('保存'.$model['title'].'成功！', U('lists?model='.$model['name']));
            } else {
                $this->error($Model->getError());
            }
        } else {

            //获取数据
            $data       = M(get_table_name($model['id']))->find($id);
            $data || $this->error('数据不存在！');

            $field_group = parse_config_attr($model['field_group']);
            $fields     = get_model_attribute($model['id']);
            $field_group['design'] = '模块自定义';

            $this->assign('field_group',$field_group);
            $this->assign('model', $model);
            $this->assign('fields', $fields);
            $this->assign('data', $data);
            $this->meta_title = '编辑'.$data['title'];
            $this->display($model['template_edit']?$model['template_edit']:'');
        }
    }

    public function add(){
        $this->assign('active_menu','modules/lists');
        $_POST['create_time'] = time_format();
        parent::add($this->model_id);
    }

    private function home_product(){

        $products = I('post.products');
        $pics = I('post.pics');
        $module_id = I('post.id');

        M('product_module')->where(['module_id'=>$module_id])->delete();

        $data = [];
        foreach($products as $key=>$product_id){

            $tmp = [
                    'module_id'=>$module_id,
                    'product_id'=>$product_id,
                    'product_pic'=>(isset($pics[$key]) ? $pics[$key] : ''),
                    'create_time'=>time_format(null,'Y-m-d H:i:s'),
                    'ordering'=>$key
                ];
//            M('product_module')->add($tmp);
            $data[] = $tmp;
        }
//        var_dump($data);
        //清空前台缓存
        $api = new ApiService();
        $api->setApiUrl(C('APIURI.mall'))
            ->setData()->send('index/console/cleanCache');

        M('product_module')->addAll($data);
    }
}