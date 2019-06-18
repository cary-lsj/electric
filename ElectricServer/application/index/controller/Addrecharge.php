<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/10
 * Time: 16:22
 */

namespace app\index\controller;


use app\common\model\Recharge;
use app\common\model\User;
//管理员充值
class Addrecharge extends BaseHandle
{
    function Index()
    {
        //用户id
        $userid = $this->postdata->userid;
        //后去用户
        $user = User::get($userid);
        if(is_null($user))
        {
            //如果不存在该用户
            $msg = array(
                'errorCode'=>$this->config_error["userinvaild"],//无效用户
            );
            $this->sendMsg($msg);
        }
            //获取充值金额
            $money = $this->postdata->money;
            //计算余额
            $user->balance = $user->balance+$money;
            //累计充值额
            $user->recharge =  $user->recharge + $money;
            //插入数据，将数据保存到数据库中
            $res = $user ->save();
            if(!$res)
            {
                $msg = array(
                    'errorCode'=>$this->config_error["operationfiled"],//操作失败
                );
                $this->sendMsg($msg);
            }
            //充值记录
            $model = new Recharge();
            //充值时间为当前时间
            $model->time = $this->getTime();
            //来源 是管理员充值
            $model->source = $this->config_data["sourcetype"]["admin"];
            //充值的专柜id
            $model->userid = $userid;
            //充值的金额
            $model->money = $money;
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