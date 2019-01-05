<?php
/**
 * Created by PhpStorm.
 * User: Suu
 * Date: 2019/1/4
 * Time: 17:02
 */
namespace app\active\controller;


use app\active\model\Main as ActiveModel;

class MainController extends BaseController
{

    // default
    public function Index(){
        $data = $this->request->param();
        $result = $this->validate($data, 'Main');
        if ($result !== true){
            $this->error($result);
        }
        // 解密/查询两次
        $active = secret($data['a'],"qazwsxedcrfvtgbyhnujmiklop",true);
        // 获取活动详细信息
        $activeInfo = ActiveModel::find($active)->toArray();
        // 异常处理
        // 1. 判断结束时间和当前时间
        $nowTime = date("Y-m-d H:i:s");
        if (strtotime($nowTime) > strtotime($activeInfo['end_time'])){
            $this->assign("end",true);
        }


//        $remTime = $activeInfo['start_time'] - $activeInfo['end_time'];

//        dump($activeInfo);



        $this->assign("active",$activeInfo);

        return $this->fetch();
    }

    // check
}