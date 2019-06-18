<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/11
 * Time: 17:41
 */

namespace app\index\controller;


use app\common\model\User;

class Updateuserpassword extends BaseHandle
{
    function Index()
    {
        //检测用户发送的消息是否为空
        $this->CheckPostEmpty();
        //账号
        $id = $this->postdata->userid;

        //原密码 用MD5加密
        $sPassWord = md5($this->postdata->password);
        //新密码
        $newpassword = md5($this->postdata->newpassword);
        //通过字段名查找是否存在
        $model = User::get($id);
        //如果该学生不存在
        if(is_null($model))
        {
            $msg = array(
                'errorCode'=>$this->config_error["userinvaild"],//无效用户
            );
            $this->SendMsg($msg);
        }
        //如果存在该学生
        //判断密码是否正确
        if($model->getData("password") !== $sPassWord) {
            $msg = array(
                'errorCode' => $this->config_error["pwderror"]//密码错误
            );
            $this->sendMsg($msg);
        }

        $model -> password = $newpassword;
        $res = $model->save();
        if(!$res)
        {
            $msg = array(
                'errorCode'=>$this->config_error["operationfiled"],//操作失败
            );
            $this->sendMsg($msg);
        }

        $msg = array(
            'errorCode'=>$this->config_error["success"],//操作成功
        );
        $this->sendMsg($msg);

    }
}