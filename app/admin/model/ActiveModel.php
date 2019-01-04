<?php
/**
 * Created by PhpStorm.
 * User: Suu
 * Date: 2019/1/3
 * Time: 16:26
 */

namespace app\admin\model;


use think\Model;

class ActiveModel extends Model
{
    protected $createTime = 'create_at';
    protected $updateTime = 'update_at';

    protected $autoWriteTimestamp = 'datetime';

    public function getStatusAttr($value)
    {
        $status = [0=>'关闭',1=>'开启'];
        return $status[$value];
    }

    public function addNewActive($data){
        return $this->save($data);
    }
}