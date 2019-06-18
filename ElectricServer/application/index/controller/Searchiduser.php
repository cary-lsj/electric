<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/10
 * Time: 21:00
 */

namespace app\index\controller;


use app\common\model\User;

class Searchiduser extends BaseHandle
{

    function Index()
    {
        //负责人的id
        $id = $this->postdata->userid;
        //通过id获取某个用户对象
        $model =User::get($id);
        //获取该对象信息
        $info = $model->getInfo();
        //单价
        $price = $this->getPrice();
        //发给前端的数据
        $msg=array(
            'errorCode' => $this->config_error["success"],
            'allinfo'=>$info,
            'price' => $price
        );
        //发送数据
        $this->SendMsg($msg);
    }
}