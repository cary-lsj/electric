<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/8
 * Time: 15:27
 */

namespace app\index\controller;


use app\common\model\Admin;

//管理员登录
class Adminlogin extends BaseHandle
{
    public function Index()
    {
        //检测用户发送的消息是否为空
        $this->CheckPostEmpty();
        //管理员 用户名
        $sName = $this->postdata->username;
        //密码 用MD5加密
//        $sPassWord = md5($this->postdata->password);
        $sPassWord = $this->postdata->password;
        //通过字段名查找是否存在
        $Ruser= array("username" => $sName);
        $admin = Admin::get($Ruser);
        //判断该管理员是否存在
        if(!is_null($admin)){
            //如果存在该管理员
            //判断密码是否正确
            if($admin->getData("password") !== $sPassWord){
                $ret = array(
                    'errorCode'=>$this->config_error["pwderror"]//密码错误
                );
            }
            else{
                $ret = array(
                    'errorCode'=>$this->config_error["success"],//登陆成功
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