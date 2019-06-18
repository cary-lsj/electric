<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/9
 * Time: 18:17
 */

namespace app\index\controller;


use app\common\model\User;

class Userinfo extends BaseHandle
{
    function Index()
    {
        //负责人的id
        $id = $this->postdata->id;
        //通过id获取某个用户对象
        $model =User::get($id);
        //要发给前端的数据
        $info =$model->GetInfo();
        //发给前端的数据
        $msg=array(
            'errorCode' => $this->config_error["success"],
            'allinfo' => $info,
        );
        //发送数据
        $this->SendMsg($msg);
    }
}