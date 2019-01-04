<?php
/**
 * Created by PhpStorm.
 * User: Suu
 * Date: 2019/1/4
 * Time: 17:02
 */
namespace app\active\controller;
use think\Controller;


class MainController extends Controller
{
    public function Index(){
        var_dump($this->request->param());
    }
}