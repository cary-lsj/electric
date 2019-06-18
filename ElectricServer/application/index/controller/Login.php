<?php

namespace app\index\controller;
use app\common\model\User;

//用户登录
class Login extends BaseHandle
{
    public function Index()
    {
        //检测用户发送的消息是否为空
        $this->CheckPostEmpty();
        //账号
        $sName = $this->postdata->username;

        //密码 用MD5加密
        $sPassWord = md5($this->postdata->password);
        //通过字段名查找是否存在
        $Ruser= array("username" => $sName);
        $model = User::get($Ruser);
        //判断该学生是否存在
        if(!is_null($model)){
            //如果存在该学生
            //判断密码是否正确
            if($model->getData("password") !== $sPassWord){
                $ret = array(
                      'errorCode'=>$this->config_error["pwderror"]//密码错误
                );
            }
            else{
                //获取该学生所有信息
                $allinfo = $model->GetInfo();
                $ret = array(
                    'errorCode'=>$this->config_error["success"],//登陆成功
                    'allinfo' => $allinfo,
                );
            }
        }else{
            $ret = array(
                'errorCode'=>$this->config_error["userinvaild"],//无效用户
            );
        }
        $this->SendMsg($ret);
    }
}