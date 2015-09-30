<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;

/**
 * 行为控制器
 * @author huajie <banhuajie@163.com>
 */
class CustommanageController extends AdminController {

    /**
     * 行为日志列表
     * @author huajie <banhuajie@163.com>
     */
    public function index(){
	    if(!empty(I('parent_name')))
	    {
		    $map['parent_name']= array('like', '%'.I('parent_name').'%');
	    }
	    if(!empty(I('baby_sex')))
	    {
		    $map['baby_sex']= I('baby_sex');
	    }
        $map['status']    =   'CRT';
        $list   =   $this->lists('khkf_candidate', $map,'update_time desc');
        $this->assign('_list', $list);
        $this->meta_title = '开发客户列表';
        $this->display();
    }

    /**
     *编辑 
     */
    public function edit($id = 0){
        empty($id) && $this->error('参数错误！');
        $info = M('khkf_candidate')->field(true)->find($id);
        $this->assign('data', $info);
        $this->meta_title = '编辑客户信息';
        $this->display();
    }

    public function info($id = 0){
        empty($id) && $this->error('参数错误！');
        $info = M('khkf_candidate')->field(true)->find($id);
        $this->assign('item', $info);
        $this->meta_title = '查看客户信息';
        $this->display();
    }
    public function add(){
        $this->meta_title = '添加客户信息';
        $this->display();
    }
    public function save(){
        $data['parent_name'] = I('post.parent_name');
        empty($data['parent_name']) && $this->error('请输入家长姓名');
        $data['mobile_num'] = I('post.mobile_num');
        empty($data['mobile_num']) && $this->error('请输入家长电话号码');
        $data['baby_name'] = I('post.baby_name');
        empty($data['baby_name']) && $this->error('请输入宝贝姓名');
        $data['baby_sex'] = I('post.baby_sex');
        empty($data['baby_sex']) && $this->error('请输入宝贝性别');
        $data['star'] = I('post.star');
        $data['star'] =='' && $this->error('请输入候选人星数');
        $data['district'] = I('post.district');
        empty($data['district']) && $this->error('请输入家庭所在城市区域');
        $data['city'] = I('post.city');
        empty($data['city']) && $this->error('请输入家庭所有城市');
        $data['baby_birthday']= I('post.baby_birthday');
        empty($data['baby_birthday']) && $this->error('请输入宝宝出生年月');
        $data['level']= I('post.level');
        $id = I('post.id');
	if(empty($id))
	{
		$data['insert_time'] = date("Y-m-d H:i:s");
		$data['status'] = "CRT";
		$res = M('khkf_candidate')->add($data);
	}else{
		$data['update_time'] = date("Y-m-d H:i:s");
		$res = M('khkf_candidate')->where('id='.$id)->save($data);
	} 
        if($res !== false){
            $this->success('保存成功！',U('custommanage/index'));
        }else {
            $this->error('保存失败！');
        }
    }

    public function allocate(){
	    if(!empty(I('parent_name')))
	    {
		    $map['parent_name']= array('like', '%'.I('parent_name').'%');
	    }
	    if(!empty(I('mobile_num')))
	    {
		    $map['mobile_num']= I('parent_name');
	    }
	    if(!empty(I('baby_name')))
	    {
		    $map['baby_name']= array('like', '%'.I('baby_name').'%');
	    }
	    if(!empty(I('status')))
	    {
		    $map['c.status']= I('status');
	    }
//	    $map['c.status']    =   'CRT';
	    $model = M('khkf_candidate c')->join('t_ucenter_member m on current_assistant_id=m.id','left')->field('c.*,m.username');
	    $list   =   $this->lists($model, $map,'update_time desc','c.*,m.username');
	    $this->assign('_list', $list);
	    $this->assign('status', I('status'));
	    $this->meta_title = '调配客户列表';
	    $this->display();
    }
    public function allocatesave()
    {
	    $current_assistant_id = I('post.current_assistant_id');
	    $id = I('get.id');
	    empty($id) && $this->error('参数错误');
	    $model = M('khkf_candidate');
	    $model->startTrans(); 
	    $res = $model->where('id='.$id)->save(['current_assistant_id'=>$current_assistant_id,'update_time'=>date("Y-m-d H:i:s")]);
	    if($res !== false){
		    $rest =  M('khkf_candidate_develop')->add(['candidate_id'=>$id,'assistant_id'=>$current_assistant_id,'insert_time'=>date("Y-m-d H:i:s")]);
		    if($rets!==false)
		    {
			    $model->commit();
			    $this->success('保存成功！',U('custommanage/allocate'));
		    }
	    }
	    $model->rollback(); 
	    $this->error('保存失败！');
    }
    public function allocateinfo($id=0)
    {
        empty($id) && $this->error('参数错误！');
        $info = M('khkf_candidate')->find($id);
        $this->assign('item', $info);
        $assi = M('ucenter_member')->where("user_type='ASST'")->getField('id,username');
        $this->assign('assi', $assi);
        $this->meta_title = '客户信息详情';
        $this->display();
    }
    public function setStatus()
    {
	    $type = I('get.type');
	    $id = I('get.id');
	    $status = $type=='S'?'OK#':'FLS';
	    $res = M('khkf_candidate')->where('id='.$id)->save(['update_time'=>date('Y-m-d H:i:s'),'status'=>$status]);
	    if($res !== false){
		    $this->success('设置完成！',U('custommanage/allocate'));
	    }else {
		    $this->error('保存失败！');
	    }
    }
    function batchadd()
    {
        if(IS_POST){
		$this->upload();
	}
        $this->meta_title = '批量导入';
        $this->display();
    }
    function upload()
    {
	    $file_item = json_to_array(think_decrypt(I('post.file_id')));
	    if (empty($file_item)) {
		    $this->error('找不到上传文件!');
	    }
	    vendor('ExcelReader.excel_reader2');
	    vendor('ExcelReader.SpreadsheetReader');

	    $config = C('DOWNLOAD_UPLOAD');
	    $Filepath = $config['rootPath'] . $file_item['savepath'] . $file_item['savename'];

	    $Spreadsheet = new \SpreadsheetReader($Filepath);
	    $Sheets = $Spreadsheet->Sheets();
	    $candidate = [];
	    foreach ($Sheets as $Index => $Name){
		    $Spreadsheet -> ChangeSheet($Index);
		    foreach ($Spreadsheet as $Key => $Row)
		    {
			    if($Key < 2){
				    continue;
			    }
			    if ($Row && is_array($Row) && count($Row) > 3)
			    {
//				    $sex = $Row[3]=='男'?'MALE###':($Row[3]=='女'?'FEMALE#':'UNKNOWN');
				    if($Row[3]=='男')
				    {
					    $sex="MALE###";
				    }elseif($Row[3]=='女'){
					    $sex='FEMALE#';
				    }else{
					    $sex='UNKNOWN';
				    }
				    $birthday= strtotime($Row[4]);
				    $day = date('Y-m-d',$birthday);
				    $time = date('Y-m-d H:i:s');
				    $candidate[] = [
					    'mobile_num'=>$Row[0],
					    'parent_name'=>$Row[1],
					    'baby_name'=>$Row[2],
					    'baby_sex'=>$sex,
					    'baby_birthday'=>$day,
					    'city'=>$Row[5],
					    'district'=>$Row[6],
					    'status'=>'CRT',
					    'insert_time'=>$time,
					    'update_time'=>$time,
					    ];
			    }
		    }
	    }
	    $res = M('khkf_candidate')->addAll($candidate);
	    if($res !== false){
		    $this->success('批量添加完成！');
	    }else {
		    $this->error('批量添加失败！');
	    }
    }
}
