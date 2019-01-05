<?php
/**
 * Created by PhpStorm.
 * User: Suu
 * Date: 2019/1/5
 * Time: 17:00
 */

namespace app\active\validate;


use think\Db;
use think\Validate;

class MainValidate extends Validate
{
    protected $rule = [
        'a' => 'require|checkActiveID',
        'u' => 'checkUserID'
    ];

    protected $message = [
      'a' => '活动异常,请刷新重试'
    ];

    protected function checkActiveID($value){
        $activeid = secret($value,"qazwsxedcrfvtgbyhnujmiklop",true);
        $findID = Db::table('cmf_active')->where('id','=',$activeid)->value('id');
        if ($findID != $activeid){
            return false;
        }
        return true;
    }

    protected function checkUserID($value){
        return true;
    }



}