<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/9
 * Time: 18:17
 */

namespace app\index\controller;


use app\common\model\User;

class Userallinfo extends BaseHandle
{

    function Index()
    {
        //声明一个数组 存所有用户的信息
        $AllInfo= array();
        //实例化用户表
        $model = new User();
        //查询所有学生对象
        $model = $model->select();
        //遍历学生对象
        foreach ( $model as $k=>$v )
        {
            //获取当前学生的所有信息
            $info=$v->GetInfo();
            //讲当前学生信息存入   存所有学生的信息  数组里面
            array_push($AllInfo,$info);
        }
        //组织返回前端的数据
        $msg=array(
            'errorCode' => $this->config_error["success"],
            'allinfo' => $AllInfo,
        );
        //发送数据
        $this->SendMsg($msg);
    }
}