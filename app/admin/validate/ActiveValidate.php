<?php
/**
 * Created by PhpStorm.
 * User: Suu
 * Date: 2019/1/3
 * Time: 15:55
 */

namespace app\admin\validate;


use think\Validate;

class ActiveValidate extends Validate
{
    protected $rule = [
        'name'  => 'require|length:4,50',
        'description'  => 'require|min:10',
        'piece' => 'require|float',
        'start_time' => 'require|date',
        'img'=>'require',
        'end_time' => 'require|date',
        'phone' => 'require',
        'address' => 'require',
    ];

    protected $message = [
        'img'=>'封面图不能为空',
    ];
}