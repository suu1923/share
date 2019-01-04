<?php
/**
 * Created by PhpStorm.
 * User: Suu
 * Date: 2019/1/4
 * Time: 17:02
 */
namespace app\active\controller;


class MainController extends BaseController
{

    // default
    public function Index(){
        var_dump($this->request->param());

        $data = $this->request->param();

        if (empty($data['a']) && empty($data['u'])){
            echo 1;
        }

        return $this->fetch();
    }

    // check
}