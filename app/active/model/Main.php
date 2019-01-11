<?php
/**
 * Created by PhpStorm.
 * User: Suu
 * Date: 2019/1/5
 * Time: 17:19
 */

namespace app\active\model;


use think\Model;

class Main extends  Model
{

    protected $table = 'cmf_active';

    protected $hidden = ['create_at', 'update_at'];


    protected  function getEndTimeAttr($value){
        return strtotime($value);
    }

    protected function getContentAttr($value){
        return htmlspecialchars_decode($value);
    }

}