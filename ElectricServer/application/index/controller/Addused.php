<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/10
 * Time: 16:45
 */

namespace app\index\controller;


use app\common\model\User;

//录入用电
class Addused extends BaseHandle
{
    function Index()
    {
        //用户id
        $userid = $this->postdata->userid;
        $user = User::get($userid);
        if(is_null($user))
        {
            $msg = array(
                'errorCode'=>$this->config_error["userinvaild"],//无效用户
            );
            $this->sendMsg($msg);
        }
        //获取使用电量
        $used = $this->postdata->used;
        //计算余额
        $user->balance = $user->balance - $used*$this->getPrice();
        //累计使用电量
        $user->used = $user->used + $used;
        //保存到数据库中
        $res = $user ->save();
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