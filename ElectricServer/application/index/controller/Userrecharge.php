<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/11
 * Time: 19:30
 */

namespace app\index\controller;


use app\common\model\Recharge;
use app\common\model\User;

class Userrecharge extends BaseHandle
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
        //获取金额
        $money = $this->postdata->money;
        //更新余额
        $user->balance = $user->balance+$money;
        //累计总额
        $user->recharge =  $user->recharge + $money;
        //保存数据到数据库
        $res = $user ->save();
        if(!$res)
        {
            $msg = array(
                'errorCode'=>$this->config_error["operationfiled"],//操作失败
            );
            $this->sendMsg($msg);
        }
        //new 一个新的充值记录
        $model = new Recharge();
        //后去当前时间
        $model->time = $this->getTime();
        //来源是 用户
        $model->source = $this->config_data["sourcetype"]["user"];
        //充值人id
        $model->userid = $userid;
        //充值金额
        $model->money = $money;
        //保存数据到数据库
        $res = $model -> save();
        if(!$res)
        {
            $msg = array(
                'errorCode'=>$this->config_error["operationfiled"],//操作失败
            );
            $this->sendMsg($msg);
        }
        $msg = array(
            'errorCode'=>$this->config_error["success"],//操作成功
            'username'=>$user->username,
            'balance'=>$user->balance,
        );
        $this->sendMsg($msg);


    }
}