<?php
/**
 * Created by PhpStorm.
 * User: Suu
 * Date: 2019/1/3
 * Time: 14:27
 */

namespace app\admin\controller;


use app\admin\model\ActiveModel;
use cmf\controller\AdminBaseController;

class ActiveController extends  AdminBaseController
{

    public function Init(){
        // todo
    }
    public function index()
    {
        $content = hook_one('admin_active_index_view');
        if (!empty($content)) {
            return $content;
        }
        $ActiveModel = new ActiveModel();
        $actives        = $ActiveModel->select();
        $this->assign('actives',$actives);
        return $this->fetch();
    }

    public function add()
    {
        $content = hook_one('portal_admin_article_add_view');
        if (!empty($content)) {
            return $content;
        }
        return $this->fetch();
    }

    public function addPost(){
        if ($this->request->isPost()) {
            $data = $this->request->param();
            $post = $data['post'];
            $result = $this->validate($post, 'Active');
            if ($result !== true) {
                $this->error($result);
            }
            $portalPostModel = new ActiveModel();
            $portalPostModel->save($post);
            $this->success('添加成功!', url('Active/index'));
        }
    }
    public function changeStatus(){
        $data = $this->request->param();
        $portalPostModel = new ActiveModel();
        $result = $portalPostModel->isUpdate(true)->save($data);
        if ($result){
            $this->success("更新成功");
        }else{
            $this->error("更新失败");
        }
    }

    public function delActive(){
        $id = $this->request->param('id');

        $portalPostModel = new ActiveModel();

        $res = $portalPostModel->destroy($id);
        if ($res){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }

    public function makeUrl(){
        $id = $this->request->param('id');
        if(empty($id)){
            $this->error("ID Error");
        }
        $makeQRCode = $this->request->param('qr');
        $url = $_SERVER['HTTP_HOST'].'/share/public/active/Main/Index?a='.urlencode(secret($id,'qazwsxedcrfvtgbyhnujmiklop')).'&u=';

        if ($makeQRCode){
            Vendor('phpqrcode.phpqrcode');
            $level = 1;
            $size = 4;
            $QRCode = new \QRcode();
            $QRImg = $QRCode::png($url,false,$level,$size);
            return $QRImg;
        }else {
            return $url;
        }
    }
}