<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/10
 * Time: 20:00
 */

namespace app\index\controller;


use app\common\model\User;

//删除一个负责人
class Deluser extends BaseHandle
{
    function Index()
    {
        //负责人的id
        $id = $this->postdata->userid;
        //通过id获取某个用户对象
        $model =User::get($id);
        //删除该对象
        $model->delete();
        //发给前端的数据
        $msg=array(
            'errorCode' => $this->config_error["success"],
        );
        //发送数据
        $this->SendMsg($msg);
    }
}